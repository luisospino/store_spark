<?php

namespace App\Controllers;
use App\Models\CajasModel;

class Cajas extends BaseController
{   
    protected $cajas;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->cajas = new CajasModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Cajas', 'datos' => $cajas];
        
        return view('cajas/inicio', $array);
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Cajas eliminadas', 'datos' => $cajas];
        
        return view('cajas/eliminados', $array);
    }
    
    public function crear()
    {   
        session();   

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $array = ['titulo' => 'Agregar caja', 'validaciones' => $this->validation->listErrors()];
        
        return view('cajas/crear', $array);
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('cajas')){

            $this->cajas->save(['numero' => $this->request->getPost('numero'),
                'nombre' => $this->request->getPost('nombre')]);
    
                return redirect()->to(route_to('cajas.inicio'))->with('exito', 'Caja creada exitosamente');
        }
        
        return redirect()->back()->withInput();
    }

    public function editar($id)
    {   
        session();  

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $caja = $this->cajas->where('id', $id)->first();
        $array = ['titulo' => 'Editar caja', 'caja' => $caja, 'validaciones' => $this->validation->listErrors()];
        
        return view('cajas/editar', $array);
    }

    public function actualizar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('cajas')){
            $this->cajas->update($this->request->getPost('id'),
                ['numero' => $this->request->getPost('numero'),
                'nombre' => $this->request->getPost('nombre')]);
    
                return redirect()->to(route_to('cajas.inicio'))->with('exito', 'Caja actualizada exitosamente');
        }

        return redirect()->back()->withInput();
    }

    public function eliminar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $this->cajas->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Caja eliminada exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $this->cajas->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Caja reingresada exitosamente');
    }

}