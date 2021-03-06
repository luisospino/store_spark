<?php

namespace App\Controllers;
use App\Models\ClientesModel;

class Clientes extends BaseController
{   
    protected $clientes;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->clientes = new ClientesModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Clientes', 'datos' => $clientes];
        
        return view('clientes/inicio', $array);
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Clientes eliminados', 'datos' => $clientes];
        
        return view('clientes/eliminados', $array);
    }
    
    public function crear()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $array = ['titulo' => 'Agregar cliente', 'validaciones' => $this->validation->listErrors()];
        
        return view('clientes/crear', $array);
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        if($this->validate('clientes')){

            $this->clientes->save(['nombre' => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono') == '' ? NULL: $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion') == '' ? NULL: $this->request->getPost('direccion'),
                'correo' => $this->request->getPost('correo')]);
    
                return redirect()->to(route_to('clientes.inicio'))->with('exito', 'Cliente creado exitosamente');
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
        
        $cliente = $this->clientes->where('id', $id)->first();
        $array = ['titulo' => 'Editar cliente', 'cliente' => $cliente, 'validaciones' => $this->validation->listErrors()];
        
        return view('clientes/editar', $array);
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('clientes')){
            $this->clientes->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono') == '' ? NULL: $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion') == '' ? NULL: $this->request->getPost('direccion'),
                'correo' => $this->request->getPost('correo')]);  

                return redirect()->to(route_to('clientes.inicio'))->with('exito', 'Cliente actualizado exitosamente');
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

        $this->clientes->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Cliente eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $this->clientes->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Cliente reingresado exitosamente');
    }

    public function obtenerClientes($search)
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Supervisor'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $clientes = $this->clientes->like('nombre',$search)->where('activo', 1)->findAll();

        return json_encode($clientes);
    }

}