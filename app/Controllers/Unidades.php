<?php

namespace App\Controllers;
use App\Models\UnidadesModel;

class Unidades extends BaseController
{   
    protected $unidades;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
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

        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Unidades', 'datos' => $unidades];
        
        return view('unidades/inicio', $array);
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Unidades eliminadas', 'datos' => $unidades];
        
        return view('unidades/eliminados', $array);
    }
    
    public function crear()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $array = ['titulo' => 'Agregar unidad', 'validaciones' => $this->validation->listErrors()];
        
        return view('unidades/crear', $array);
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('unidades')){

            $this->unidades->save(['nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto')]);
    
                return redirect()->to(route_to('unidades.inicio'))->with('exito', 'Unidad creada exitosamente');
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

        $unidad = $this->unidades->where('id', $id)->first();
        $array = ['titulo' => 'Editar unidad', 'unidad' => $unidad, 'validaciones' => $this->validation->listErrors()];
        
        return view('unidades/editar', $array);
    }

    public function actualizar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('unidades')){
            $this->unidades->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto')]);
    
                return redirect()->to(route_to('unidades.inicio'))->with('exito', 'Unidad actualizada exitosamente');
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

        $this->unidades->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Unidad eliminada exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $this->unidades->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Unidad reingresada exitosamente');
    }

}