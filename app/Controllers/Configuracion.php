<?php

namespace App\Controllers;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{   
    protected $configuracion;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }
    
    public function index()
    {   
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $configuracion = $this->configuracion->first();

        $array = ['titulo' => 'Configuración de la tienda', 'configuracion' => $configuracion, 'validaciones' => $this->validation->listErrors()];
        
        return view('configuracion/inicio', $array);
    }

    public function actualizar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        if($this->validate('configuracion')){
            $this->configuracion->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre'),
                'rfc' => $this->request->getPost('rfc'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo'),
                'direccion' => $this->request->getPost('direccion'),
                'leyenda' => $this->request->getPost('leyenda')]);

            $ruta_logo = 'img/logo.png';

            if(file_exists($ruta_logo)){
                unlink($ruta_logo);
            }

            $imagen = $this->request->getFile('logo');
            $imagen->move(ROOTPATH.'/public/img', 'logo.png');
            return redirect()->back()->with('exito', 'Configuracion guardada exitosamente');
        }

        return redirect()->back()->withInput();
    }
}