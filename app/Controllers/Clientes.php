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
            return redirect()->to(base_url());
        }

        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Clientes', 'datos' => $clientes];
        
        return view('header').view('clientes/clientes', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }

        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Clientes eliminados', 'datos' => $clientes];
        
        return view('header').view('clientes/eliminados', $array).view('footer');
    }
    
    public function nuevo()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $array = ['titulo' => 'Agregar cliente', 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('clientes/nuevo', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }
        
        if($this->validate('clientes')){

            $this->clientes->save(['nombre' => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono') == '' ? NULL: $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion') == '' ? NULL: $this->request->getPost('direccion'),
                'correo' => $this->request->getPost('correo')]);
    
                return redirect()->to(base_url().'/clientes')->with('exito', 'Cliente creado exitosamente');
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
        
        $cliente = $this->clientes->where('id', $id)->first();
        $array = ['titulo' => 'Editar cliente', 'cliente' => $cliente, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('clientes/editar', $array).view('footer');
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('clientes')){
            $this->clientes->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono') == '' ? NULL: $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion') == '' ? NULL: $this->request->getPost('direccion'),
                'correo' => $this->request->getPost('correo')]);  

                return redirect()->to(base_url().'/clientes')->with('exito', 'Cliente actualizado exitosamente');
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

        $this->clientes->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Cliente eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $this->clientes->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Cliente reingresado exitosamente');
    }

    public function obtenerClientes($search)
    {
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Supervisor'){
            return redirect()->to(base_url().'/productos');
        }

        $clientes = $this->clientes->like('nombre',$search)->where('activo', 1)->findAll();

        return json_encode($clientes);
    }

}