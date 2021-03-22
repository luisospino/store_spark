<?php

namespace App\Controllers;
use App\Models\VentasModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;
use App\Models\MetodosPagosModel;

class Ventas extends BaseController
{   
    protected $ventas;
    protected $detalle_venta;
    protected $productos;
    protected $configuracion;
    protected $metodos_pagos;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->detalle_venta = new DetalleVentaModel();
        $this->productos = new ProductosModel();
        $this->configuracion = new ConfiguracionModel();
        $this->metodos_pagos = new MetodosPagosModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $ventas = $this->db->table('ventas')
                    ->join('clientes','ventas.id_cliente = clientes.id')
                    ->join('metodo_pago','ventas.id_metodo_pago = metodo_pago.id')
                    ->where('ventas.activo', $activo)
                    ->select('ventas.id, ventas.folio, ventas.total, ventas.fecha_alta, clientes.nombre cliente, metodo_pago.nombre metodo_pago')
                    ->get();

        $array = ['titulo' => 'Ventas', 'datos' => $ventas->getResultArray()];

        return view('header').view('ventas/inicio', $array).view('footer');
    }

    public function crear()
    {   
        session();    

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Supervisor'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $metodos_pagos = $this->metodos_pagos->where('activo', 1)->findAll();
        $array = ['metodos_pagos' => $metodos_pagos];
        return view('header').view('ventas/crear', $array).view('footer');
    }

    public function canceladas($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $ventas = $this->db->table('ventas')
                    ->join('clientes','ventas.id_cliente = clientes.id')
                    ->join('metodo_pago','ventas.id_metodo_pago = metodo_pago.id')
                    ->where('ventas.activo', $activo)
                    ->select('ventas.id, ventas.folio, ventas.total, ventas.fecha_alta, clientes.nombre cliente, metodo_pago.nombre metodo_pago')
                    ->get();        

        $array = ['titulo' => 'Ventas canceladas', 'datos' => $ventas->getResultArray()];

        return view('header').view('ventas/canceladas', $array).view('footer');
    }    

    public function cancelar($id)
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $this->db->transStart();

        $detalle_productos = $this->detalle_venta->where('id_venta', $id)->findAll();

        foreach($detalle_productos as $producto) {

            $producto_antiguo = $this->productos
            ->where('id', $producto['id_producto'])
            ->select('existencias')
            ->first();
            
            $existencias_nueva = (int)$producto_antiguo['existencias'] + $producto['cantidad'];
            
            $this->productos->update($producto['id_producto'],
            ['existencias' => $existencias_nueva]);
        }
        
        $this->ventas->update($id, ['activo' => 0]);

        $this->db->transComplete();
        
        return redirect()->back()->with('exito', 'Venta cancelada exitosamente');
    }
    
    public function completarVenta(){

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Supervisor'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $this->db->transStart();
        
        $id_venta = $this->ventas->insert(['folio' => uniqid(),
                'total' => $this->request->getPost('venta')['total'],
                'id_usuario' => session()->get('id_usuario'),
                'id_caja' => session()->get('id_caja'),
                'id_cliente' => $this->request->getPost('venta')['id_cliente'],
                'id_metodo_pago' => $this->request->getPost('venta')['id_metodo_pago'],
                'activo' => 1
                ]);
        
        foreach($this->request->getPost('productos') as $producto) {

            $this->detalle_venta->save(['id_venta' => $id_venta,
            'id_producto' => $producto['id'],
            'nombre' => $producto['nombre'],
            'cantidad' => $producto['cantidad'],
            'precio' => $producto['precio_venta']
            ]);
            
            $producto_antiguo = $this->productos
                        ->where('id', $producto['id'])
                        ->select('existencias')
                        ->first();

            $existencias_nueva = (int)$producto_antiguo['existencias'] - $producto['cantidad'];

            $this->productos->update($producto['id'],
                ['existencias' => $existencias_nueva]);
        }
        $this->db->transComplete();

        return json_encode($id_venta);
    }

    public function verVentaPdf($id_venta){
        
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $array = ['id_venta' => $id_venta];
        return view('header').view('ventas/ver_venta_pdf', $array).view('footer');
    }

    public function generarVentaPdf($id_venta){
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $tienda_config = $this->configuracion->select('nombre, direccion, leyenda')->first();
        $venta = $this->db->table('ventas')
                ->join('metodo_pago','ventas.id_metodo_pago = metodo_pago.id')
                ->where('ventas.id', $id_venta)
                ->select('ventas.folio, ventas.total, REPLACE(ventas.fecha_alta, "-", "/") fecha_alta, metodo_pago.nombre metodo_pago')
                ->get()
                ->getRowArray();

        $detalles_venta = $this->db->table('detalle_venta')
                        ->join('productos','detalle_venta.id_producto = productos.id')
                        ->where('detalle_venta.id_venta', $id_venta)
                        ->select('productos.codigo, detalle_venta.nombre, detalle_venta.cantidad, CONCAT("$ ",detalle_venta.precio) precio, CONCAT("$ ",(detalle_venta.cantidad * detalle_venta.precio)) subtotal')
                        ->get()
                        ->getResultArray();

        $pdf = new \FPDF('P', 'mm', [80, 200]);
        $pdf->AddPage();
        $pdf->setMargins(1.5, 2, 1.5);
        $pdf->SetTitle('venta');

        $pdf->SetFont('Courier', 'B', 10);
        $pdf->Cell(60, 5, $tienda_config['nombre'], 0 , 1, 'C');
        $pdf->Ln();

        $pdf->image(ROOTPATH.'/public/img/logo.png', 67, 8, 10, 10, 'png');
        $pdf->SetFont('Courier', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Dirección:'), 0, 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(80, 5, $tienda_config['direccion'] , 0 , 1, 'L');
        
        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(26, 5, 'Fecha y hora:', 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(80, 5, $venta['fecha_alta'] , 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(14, 5, 'Ticket:', 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(60, 5, $venta['folio'] , 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(22, 5, 'Movimiento:', 0 , 0, 'L');   
        
        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(60, 5, 'Venta' , 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);   
        $pdf->Cell(11, 5, utf8_decode('Pago: '), 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(60, 5, utf8_decode($venta['metodo_pago']) , 0 , 1, 'L');
        
        $pdf->Ln();
        $pdf->Ln();
        
        $pdf->SetFont('Courier', 'B', 8);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(77, 5, 'Detalle de productos', 0 , 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Courier', 'B', 7);
        $pdf->Cell(7, 5, utf8_decode('Cant') , 1 , 0, 'C');
        $pdf->Cell(24, 5, utf8_decode('Nombre') , 1 , 0, 'C');
        $pdf->Cell(23, 5, 'Precio' , 1 , 0, 'C');
        $pdf->Cell(23, 5, 'Subtotal' , 1 , 1, 'C');

        $pdf->SetFont('Courier', '', 7);

        foreach($detalles_venta as $detalle){
            $pdf->Cell(7, 5, $detalle['cantidad'], 1 , 0, 'C');
            $pdf->Cell(24, 5, $detalle['nombre'] , 1 , 0, 'C');
            $pdf->Cell(23, 5, $detalle['precio'] , 1 , 0, 'C');
            $pdf->Cell(23, 5, $detalle['subtotal'], 1 , 1, 'C');

        }

        $pdf->SetFont('Courier', 'B', 8);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(77, 5, 'Total: $ ' . $venta['total'], 0 , 1, 'C', 1);

        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Courier', 'B', 9); 
        $pdf->MultiCell(77, 5, $tienda_config['leyenda'], 0, 'C', 0);
        
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->OutPut('venta_'.$venta['folio'].'.pdf', 'I');
    }
}