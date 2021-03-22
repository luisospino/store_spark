<?php

namespace App\Controllers;
use App\Models\RolesModel;

class Roles extends BaseController
{   
    protected $roles;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->roles = new RolesModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $roles = $this->roles->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Roles', 'datos' => $roles];
        
        return view('header').view('roles/inicio', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $roles = $this->roles->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Roles eliminados', 'datos' => $roles];
        
        return view('header').view('roles/eliminados', $array).view('footer');
    }
    
    public function crear()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $array = ['titulo' => 'Agregar rol', 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('roles/crear', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('roles')){

            $this->roles->save(['nombre' => $this->request->getPost('nombre')]);
    
            return redirect()->to(route_to('roles.inicio'))->with('exito', 'Rol creado exitosamente');
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

        $rol = $this->roles->where('id', $id)->first();
        $array = ['titulo' => 'Editar rol', 'rol' => $rol, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('roles/editar', $array).view('footer');
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('roles')){
            $this->roles->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre')]);  

                return redirect()->to(route_to('roles.inicio'))->with('exito', 'Rol actualizado exitosamente');
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

        $this->roles->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Rol eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $this->roles->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Rol reingresado exitosamente');
    }

}