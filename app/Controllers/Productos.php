<?php

namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;

class Productos extends BaseController
{   
    protected $productos;
    protected $unidades;
    protected $categorias;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->unidades = new UnidadesModel();
        $this->categorias = new CategoriasModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }

        $productos = $this->productos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Productos', 'datos' => $productos];
        
        return view('header').view('productos/productos', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }
        
        $productos = $this->productos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Productos eliminados', 'datos' => $productos];
        
        return view('header').view('productos/eliminados', $array).view('footer');
    }
    
    public function nuevo()
    {   
        session();  

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $array = ['titulo' => 'Agregar producto', 'unidades' => $unidades, 'categorias' => $categorias, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('productos/nuevo', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('productos')){

            $this->generarCodigoBarra($this->request->getPost('codigo'));

            $this->productos->save(['codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')]);

            return redirect()->to(base_url().'/productos')->with('exito', 'Producto creado exitosamente');
        }
        
        return redirect()->back()->withInput();
    }

    public function editar($id)
    {   
        session();  
        
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $producto = $this->productos->where('id', $id)->first();

        $array = ['titulo' => 'Editar producto', 'producto' => $producto,'unidades' => $unidades, 'categorias' => $categorias, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('productos/editar', $array).view('footer');
    }

    public function actualizar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('productos')){

            $producto = $this->productos->find($this->request->getPost('id'));
            
            if( strcmp($producto['codigo'], $this->request->getPost('codigo')) != 0){
                $this->eliminarCodigoBarra($producto['codigo']);
                $this->generarCodigoBarra($this->request->getPost('codigo'));
            }

            $this->productos->update($this->request->getPost('id'),
                ['codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')]);
    
                return redirect()->to(base_url().'/productos')->with('exito', 'Producto actualizado exitosamente');
        }

        return redirect()->back()->withInput();
    }

    public function eliminar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $this->productos->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Producto eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }
        
        $this->productos->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Producto reingresado exitosamente');
    }

    public function obtenerProductos($search)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Supervisor'){
            return redirect()->to(base_url().'/productos');
        }

        $productos = $this->productos->like('codigo', $search)->where('activo', 1)->findAll();

        return json_encode($productos);
    }

    public function generarCodigoBarra($codigo){

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $generador = new \Barcode_generator();
        $generador->barcode(ROOTPATH.'/img/barcodes/'.$codigo.'.png', $codigo, 30, "horizontal", "code128", true);
    }

    public function eliminarCodigoBarra($codigo){

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if(file_exists(ROOTPATH.'/public/img/barcodes/'.$codigo.'.png')){
            unlink(ROOTPATH.'/public/img/barcodes/'.$codigo.'.png');
        }
    }

    public function verCodigosBarrasPdf(){
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        return view('header').view('productos/verCodigosBarrasPdf').view('footer');
    }

    public function generarCodigosBarrasPdf(){
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }
        
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->setMargins(9, 9, 9);
        $pdf->SetTitle('Codigos de barras');
        $pdf->SetFont('Courier', 'B', 14);
        $pdf->Cell(195, 5, utf8_decode('Códigos de barras de productos'), 0 , 1, 'C');
        $pdf->Ln();
        $pdf->Ln();

        $productos = $this->productos->where('activo', 1)->findAll();

        $posicionX = 13;
        $posicionY = 27;
        $pdf->SetX($posicionX);
        $pdf->SetY($posicionY);

        $counterX = 0;
        $counterY = 1;

        foreach ($productos as $producto) {
            $counterX++;
            $pdf->SetX($posicionX);
            $pdf->SetY($posicionY);
            $codigo = $producto['codigo'];
            $pdf->image(ROOTPATH.'/public/img/barcodes/'.$codigo.'.png', $posicionX, $posicionY, 40, 17, 'png');
            $posicionX += 50;

            if($counterX == 4){
                $counterX = 0;
                $counterY++;
                $posicionX = 13;
                $posicionY += 21;
            }

            if($counterY == 13){
                $counterX = 0;
                $counterY = 1;
                $pdf->AddPage();
                $posicionX = 13;
                $posicionY = 27;
            }
        }        

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->OutPut('codigos_de_barras.pdf', 'I');
    }

    public function verCodigosBarrasEliminadosPdf(){
        
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        return view('header').view('productos/verCodigosBarrasEliminadosPdf').view('footer');
    }

    public function generarCodigosBarrasEliminadosPdf(){
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->setMargins(9, 9, 9);
        $pdf->SetTitle('Codigos de barras eliminados');
        $pdf->SetFont('Courier', 'B', 14);
        $pdf->Cell(195, 5, utf8_decode('Codigos de barras de productos eliminados'), 0 , 1, 'C');
        $pdf->Ln();
        $pdf->Ln();

        $productos = $this->productos->where('activo', 0)->findAll();

        $posicionX = 13;
        $posicionY = 27;
        $pdf->SetX($posicionX);
        $pdf->SetY($posicionY);

        $counterX = 0;
        $counterY = 1;

        foreach ($productos as $producto) {
            $counterX++;
            $pdf->SetX($posicionX);
            $pdf->SetY($posicionY);
            $codigo = $producto['codigo'];
            $pdf->image(ROOTPATH.'/public/img/barcodes/'.$codigo.'.png', $posicionX, $posicionY, 40, 17, 'png');
            $posicionX += 50;

            if($counterX == 4){
                $counterX = 0;
                $counterY++;
                $posicionX = 13;
                $posicionY += 21;
            }

            if($counterY == 13){
                $counterX = 0;
                $counterY = 1;
                $pdf->AddPage();
                $posicionX = 13;
                $posicionY = 27;
            }
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->OutPut('codigos_de_barras_eliminados.pdf', 'I');
    }
}