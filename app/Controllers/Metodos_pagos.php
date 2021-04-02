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
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $metodos_pagos = $this->metodos_pagos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Métodos de pagos', 'datos' => $metodos_pagos];
        
        return view('metodos_pagos/inicio', $array);
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $metodos_pagos = $this->metodos_pagos->where('activo', $activo)->findAll();
        $array = ['titulo' => 'Métodos de pagos eliminados', 'datos' => $metodos_pagos];
        
        return view('metodos_pagos/eliminados', $array);
    }
    
    public function crear()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $array = ['titulo' => 'Agregar método', 'validaciones' => $this->validation->listErrors()];
        
        return view('metodos_pagos/crear', $array);
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('metodos_pagos')){

            $this->metodos_pagos->save(['nombre' => $this->request->getPost('nombre')]);
    
            return redirect()->to(route_to('metodos_pagos.inicio'))->with('exito', 'Método de pago creado exitosamente');
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

        $metodo_pago = $this->metodos_pagos->where('id', $id)->first();
        $array = ['titulo' => 'Editar método de pago', 'metodo_pago' => $metodo_pago, 'validaciones' => $this->validation->listErrors()];
        
        return view('metodos_pagos/editar', $array);
    }

    public function actualizar()
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('metodos_pagos')){
            $this->metodos_pagos->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre')]);  

                return redirect()->to(route_to('metodos_pagos.inicio'))->with('exito', 'Método de pago actualizado exitosamente');
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

        $this->metodos_pagos->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Método de pago eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $this->metodos_pagos->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Método de pago reingresado exitosamente');
    }

}