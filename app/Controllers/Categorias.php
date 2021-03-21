<?php

namespace App\Controllers;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{   
    protected $categorias;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();
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

        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Categorías', 'datos' => $categorias];
        
        return view('header').view('categorias/categorias', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(base_url().'/productos');
        }

        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Categorias eliminadas', 'datos' => $categorias];
        
        return view('header').view('categorias/eliminados', $array).view('footer');
    }
    
    public function nuevo()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $array = ['titulo' => 'Agregar categoría', 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('categorias/nuevo', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('categorias')){

            $this->categorias->save(['nombre' => $this->request->getPost('nombre')]);
    
            return redirect()->to(base_url().'/categorias')->with('exito', 'Categoria creada exitosamente');
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

        $categoria = $this->categorias->where('id', $id)->first();
        $array = ['titulo' => 'Editar categoría', 'categoria' => $categoria, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('categorias/editar', $array).view('footer');
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('categorias')){
            $this->categorias->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre')]);  

                return redirect()->to(base_url().'/categorias')->with('exito', 'Categoria actualizada exitosamente');
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

        $this->categorias->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Categoria eliminada exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }
        
        $this->categorias->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Categoria reingresada exitosamente');
    }

}