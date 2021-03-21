<?php

namespace App\Controllers;
use App\Models\MetodosPagosModel;

class Metodos_pagos extends BaseController
{   
    protected $metodos_pagos;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->metodos_pagos = new MetodosPagosModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $metodos_pagos = $this->metodos_pagos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Métodos de pagos', 'datos' => $metodos_pagos];
        
        return view('header').view('metodos_pagos/metodos', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $metodos_pagos = $this->metodos_pagos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Métodos de pagos eliminados', 'datos' => $metodos_pagos];
        
        return view('header').view('metodos_pagos/eliminados', $array).view('footer');
    }
    
    public function nuevo()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $array = ['titulo' => 'Agregar método', 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('metodos_pagos/nuevo', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('metodos_pagos')){

            $this->metodos_pagos->save(['nombre' => $this->request->getPost('nombre')]);
    
            return redirect()->to(base_url().'/metodos_pagos')->with('exito', 'Método de pago creado exitosamente');
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

        $metodo_pago = $this->metodos_pagos->where('id', $id)->first();
        $array = ['titulo' => 'Editar método de pago', 'metodo_pago' => $metodo_pago, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('metodos_pagos/editar', $array).view('footer');
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        if($this->validate('metodos_pagos')){
            $this->metodos_pagos->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre')]);  

                return redirect()->to(base_url().'/metodos_pagos')->with('exito', 'Método de pago actualizado exitosamente');
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

        $this->metodos_pagos->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Método de pago eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }
        
        $this->metodos_pagos->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Método de pago reingresado exitosamente');
    }

}