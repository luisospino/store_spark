<?php

namespace App\Controllers;
use App\Models\LogsModel;

class logs extends BaseController
{   
    protected $logs;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->logs = new LogsModel();
        $this->db = \Config\Database::connect();
    }
    
    public function index($activo = 1)
    {   
        if(!session()->has('rol')){
            return redirect()->to(base_url());
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(base_url().'/productos');
        }

        $logs = $this->db->table('logs')
                ->join('usuarios', 'logs.id_usuario = usuarios.id')
                ->join('roles', 'usuarios.id_rol = roles.id')
                ->whereNotIn('roles.nombre',['Administrador'])
                ->select('logs.*, usuarios.nombre nombre_usuario, roles.nombre rol')
                ->get();

        $array = ['titulo' => 'Logs de acceso', 'datos' => $logs->getResultArray()];
        
        return view('header').view('logs/logs', $array).view('footer');
    }
}