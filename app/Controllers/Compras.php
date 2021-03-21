<?php

namespace App\Controllers;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;

class Compras extends BaseController
{   
    protected $compras;
    protected $detalle_compra;
    protected $productos;
    protected $configuracion;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();
        $this->productos = new ProductosModel();
        $this->configuracion = new ConfiguracionModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        $compras = $this->compras->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Compras', 'datos' => $compras];
        
        return view('header').view('compras/compras', $array).view('footer');
    }

    public function nuevo()
    {   
        session(); 
        
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $array = ['titulo' => 'Agregar compra'];
        
        return view('header').view('compras/nuevo', $array).view('footer');
    }

    public function canceladas($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }
        
        $compras = $this->compras->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Compras canceladas', 'datos' => $compras];
        
        return view('header').view('compras/canceladas', $array).view('footer');
    }    

    public function cancelar($id)
    {
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $this->db->transStart();
        
        $detalle_productos = $this->detalle_compra->where('id_compra', $id)->findAll();
        
        foreach($detalle_productos as $producto) {
            
            $producto_antiguo = $this->productos
            ->where('id', $producto['id_producto'])
            ->select('existencias')
            ->first();
            
            $existencias_nueva = (int)$producto_antiguo['existencias'] - $producto['cantidad'];
            
            $this->productos->update($producto['id_producto'],
            ['existencias' => $existencias_nueva]);
        }
        
        $this->compras->update($id, ['activo' => 0]);

        $this->db->transComplete();
        
        return redirect()->back()->with('exito', 'Compra cancelada exitosamente');
    }
    
    public function completarCompra(){

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $this->db->transStart();
        
        $id_compra = $this->compras->insert(['folio' => uniqid(),
        'total' => $this->request->getPost('compra')['total'],
        'id_usuario' => session()->get('id_usuario'),
        'activo' => 1
        ]);        
        
        foreach($this->request->getPost('productos') as $producto) {

            $this->detalle_compra->save(['id_compra' => $id_compra,
            'id_producto' => $producto['id'],
            'nombre' => $producto['nombre'],
            'cantidad' => $producto['cantidad'],
            'precio' => $producto['precio_compra']
            ]);
            
            $producto_antiguo = $this->productos
                        ->where('id', $producto['id'])
                        ->select('existencias')
                        ->first();

            $existencias_nueva = (int)$producto_antiguo['existencias'] + $producto['cantidad'];

            $this->productos->update($producto['id'],
                ['existencias' => $existencias_nueva]);
        }
        $this->db->transComplete();

        return json_encode($id_compra);
    }

    public function verCompraPdf($id_compra){

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        $array = ['id_compra' => $id_compra];
        return view('header').view('compras/ver_compra_pdf', $array).view('footer');
    }

    public function generarCompraPdf($id_compra){

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        $tienda_config = $this->configuracion->select('nombre, direccion')->first();
        $compra = $this->compras->where('id', $id_compra)->first();
        $detalles_compra = $this->db->table('detalle_compra')
                        ->join('productos','detalle_compra.id_producto = productos.id')
                        ->where('detalle_compra.id_compra', $id_compra)
                        ->select('productos.codigo, detalle_compra.nombre descripcion, detalle_compra.cantidad, CONCAT("$ ",detalle_compra.precio) precio, CONCAT("$ ",(detalle_compra.cantidad * detalle_compra.precio)) subtotal')
                        ->get()
                        ->getResultArray();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->setMargins(9, 9, 9);
        $pdf->SetTitle('compra');

        $pdf->SetFont('Courier', 'B', 11);
        $pdf->Cell(195, 5, 'Entrada de productos', 0 , 1, 'C');
        $pdf->Ln();

        $pdf->SetFont('Courier', 'BI', 10);
        $pdf->Cell(50, 5, $tienda_config['nombre'], 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(20, 5, utf8_decode('Dirección:'), 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(80, 5, $tienda_config['direccion'] , 0 , 1, 'L');
        
        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(26, 5, 'Fecha y hora:', 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(80, 5, $compra['fecha_alta'] , 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(12, 5, 'Folio:', 0 , 0, 'L');

        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(60, 5, $compra['folio'] , 0 , 1, 'L');

        $pdf->SetFont('Courier', 'B', 9);        
        $pdf->Cell(22, 5, 'Movimiento:', 0 , 0, 'L');   
        
        $pdf->SetFont('Courier', '', 9); 
        $pdf->Cell(60, 5, 'Compra' , 0 , 1, 'L');
        $pdf->Ln();
        
        $pdf->SetFont('Courier', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 5, 'Detalle de productos', 0 , 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Courier', 'B', 9);
        $pdf->Cell(13, 5, utf8_decode('Nº') , 1 , 0, 'C');
        $pdf->Cell(32, 5, utf8_decode('Código') , 1 , 0, 'C');
        $pdf->Cell(45, 5, utf8_decode('Descripción') , 1 , 0, 'C');
        $pdf->Cell(40, 5, 'Precio' , 1 , 0, 'C');
        $pdf->Cell(25, 5, 'Cantidad' , 1 , 0, 'C');
        $pdf->Cell(40, 5, 'Subtotal' , 1 , 1, 'C');

        $pdf->SetFont('Courier', '', 9);
        $contador = 0;

        foreach($detalles_compra as $detalle){
            $contador++;
            $pdf->Cell(13, 5, $contador, 1 , 0, 'C');
            $pdf->Cell(32, 5, $detalle['codigo'] , 1 , 0, 'C');
            $pdf->Cell(45, 5, $detalle['descripcion'] , 1 , 0, 'C');
            $pdf->Cell(40, 5, $detalle['precio'] , 1 , 0, 'C');            
            $pdf->Cell(25, 5, $detalle['cantidad'], 1 , 0, 'C');
            $pdf->Cell(40, 5, $detalle['subtotal'], 1 , 1, 'C');
        }

        $pdf->SetFont('Courier', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 5, 'Total: $ '.$compra['total'], 0 , 1, 'C', 1);

        $pdf->image(ROOTPATH.'/public/img/logo.png', 185, 9, 23, 23, 'png');


        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->OutPut('compra_'.$compra['folio'].'.pdf', 'I');
    }
}