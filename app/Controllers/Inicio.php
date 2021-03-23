<?php

namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\VentasModel;

class Inicio extends BaseController
{	
	protected $productos;
	protected $ventas;
	protected $db;

	public function __construct()
    {
        $this->productos = new ProductosModel();
		$this->ventas = new VentasModel();
        $this->db = \Config\Database::connect();
    }

	public function index($activo = 1)
	{	
		if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
		
		$productos = $this->productos->where('activo', $activo)->countAllResults();

		$fecha = date('y-m-d');
        $ventas = $this->ventas->where("activo = 1 AND DATE(fecha_alta) = '$fecha'")
				->select("COUNT(id) cantidad, CONCAT('$', SUM(total)) total")
				->get()
				->getRowArray();

		$array = ["n_productos" => $productos, "ventas" => $ventas];

		return view('header').view('inicio', $array).view('footer');
	}

	//--------------------------------------------------------------------

}