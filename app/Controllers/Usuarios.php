<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\CajasModel;
use App\Models\LogsModel;

class Usuarios extends BaseController
{   
    protected $usuarios;
    protected $roles;
    protected $cajas;
    protected $logs;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->roles = new RolesModel();
        $this->cajas = new CajasModel();
        $this->logs = new LogsModel();
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

        $usuarios = $this->db->table('usuarios')
                    ->join('cajas','usuarios.id_caja = cajas.id')
                    ->join('roles','usuarios.id_rol = roles.id')
                    ->where('usuarios.activo', $activo)
                    ->select('usuarios.id, usuarios.usuario, usuarios.nombre nombre, cajas.nombre caja, roles.nombre rol')
                    ->get();
                    
        $array = ['titulo' => 'Usuarios', 'datos' => $usuarios->getResultArray()];
        
        return view('header').view('usuarios/inicio', $array).view('footer');
    }

    public function eliminados($activo = 0)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') == 'Cajero'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $usuarios = $this->db->table('usuarios')
                    ->join('cajas','usuarios.id_caja = cajas.id')
                    ->join('roles','usuarios.id_rol = roles.id')
                    ->where('usuarios.activo', $activo)
                    ->select('usuarios.id, usuarios.usuario, usuarios.nombre nombre, cajas.nombre caja, roles.nombre rol')
                    ->get();
                    
        $array = ['titulo' => 'Usuarios eliminados', 'datos' => $usuarios->getResultArray()];
        
        return view('header').view('usuarios/eliminados', $array).view('footer');
    }
    
    public function crear()
    {   
        session();   
        
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $roles = $this->roles->where('activo', 1)->findAll();
        $cajas = $this->cajas->where('activo', 1)->findAll();

        $array = ['titulo' => 'Agregar usuario', 'roles' => $roles, 'cajas' => $cajas, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('usuarios/crear', $array).view('footer');
    }

    public function insertar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('usuarios')){

            $this->usuarios->save(['nombre' => $this->request->getPost('nombre'),
                'usuario' => $this->request->getPost('usuario'),
                'id_rol' => $this->request->getPost('id_rol'),
                'id_caja' => $this->request->getPost('id_caja'),
                'clave' => password_hash($this->request->getPost('clave'), PASSWORD_BCRYPT)]);
    
                return redirect()->to(route_to('usuarios.inicio'))->with('exito', 'Usuario creado exitosamente');
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

        $roles = $this->roles->where('activo', 1)->findAll();
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $usuario = $this->usuarios->where('id', $id)->first();

        $array = ['titulo' => 'Editar usuario', 'usuario' => $usuario, 'roles' => $roles, 'cajas' => $cajas, 'validaciones' => $this->validation->listErrors()];
        
        return view('header').view('usuarios/editar', $array).view('footer');
    }

    public function actualizar()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('usuarios')){
            $this->usuarios->update($this->request->getPost('id'),
                ['nombre' => $this->request->getPost('nombre'),
                'usuario' => $this->request->getPost('usuario'),
                'id_rol' => $this->request->getPost('id_rol'),
                'id_caja' => $this->request->getPost('id_caja')]);
    
                return redirect()->to(route_to('usuarios.inicio'))->with('exito', 'Usuario actualizado exitosamente');
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

        $this->usuarios->update($id, ['activo' => 0]);

        return redirect()->back()->with('exito', 'Usuario eliminado exitosamente');
    }

    public function reingresar($id)
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }else if(session()->get('rol') != 'Administrador'){
            return redirect()->to(route_to('productos.inicio'));
        }

        $this->usuarios->update($id, ['activo' => 1]);

        return redirect()->back()->with('exito', 'Usuario reingresado exitosamente');
    }

    public function login()
    {   
        session();

        if(session()->has('rol')){
            return redirect()->to(route_to('productos.inicio'));
        }
        
        $array = ['validaciones' => $this->validation->listErrors()];        
        return view('login', $array);        
    }

    public function validar()
    {   
        if(session()->has('rol')){
            return redirect()->to(route_to('productos.inicio'));
        }

        if($this->validate('login')){
            
            $usuario = $this->db->table('usuarios')
                    ->join('roles','usuarios.id_rol = roles.id')
                    ->where('usuarios.usuario', $this->request->getPost('usuario'))
                    ->select('usuarios.id, usuarios.nombre nombre, usuarios.id_caja, usuarios.id_rol, roles.nombre rol, usuarios.clave')
                    ->get()->getRowArray();

            if($usuario != NULL){
                $hash = $usuario['clave'];

                if(password_verify($this->request->getPost('clave'), $hash)){

                    $datos_sesion = [
                        'id_usuario' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'id_caja' => $usuario['id_caja'],
                        'id_rol' => $usuario['id_rol'],
                        'rol' => $usuario['rol']
                    ];

                    $ip = $_SERVER['REMOTE_ADDR'];
                    $detalles = $_SERVER['HTTP_USER_AGENT'];

                    $this->logs->save([
                        'id_usuario' => $usuario['id'],
                        'evento' => 'Inicio de sesion',
                        'ip' => $ip,
                        'detalles' => $detalles,
                    ]);

                    session()->set($datos_sesion);

                    return redirect()->to(route_to('productos.inicio'));
                }else{
                    return redirect()->back()->with('error', 'Contraseña incorrecta');
                }
            }else{
                return redirect()->back()->with('error', 'El usuario no existe');
            }
        }
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];

        $this->logs->save([
            'id_usuario' => session()->get('id_usuario'),
            'evento' => 'Cierre de sesion',
            'ip' => $ip,
            'detalles' => $detalles,
        ]);

        session()->destroy();       
        return redirect()->to(route_to('login'));
    }

    public function editar_contrasenha()
    {
        session();

        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }
        
        $array = ['titulo' => 'Actualizar contraseña', 'validaciones' => $this->validation->listErrors()];
        return view('header').view('usuarios/editar_contrasenha', $array).view('footer');
    }

    public function actualizar_contrasenha()
    {   
        if(!session()->has('rol')){
            return redirect()->to(route_to('login'));
        }

        if($this->validate('contrasenha')){
            $usuario = $this->usuarios->where('id', session()->get('id_usuario'))->first();
            $hash = $usuario['clave'];
            
            if(password_verify($this->request->getPost('clave_actual'), $hash)){
                if(!password_verify($this->request->getPost('clave_nueva'), $hash)){

                    $this->usuarios->update(session()->get('id_usuario'),
                        ['clave' => password_hash($this->request->getPost('clave_nueva'), PASSWORD_BCRYPT)]);
                    
                    return redirect()->to(route_to('configuracion.inicio'))->with('exito', 'La contraseña fué actualizada exitosamente');;
                }else{
                    return redirect()->back()->with('error', 'La contraseña actual debe ser diferente a la nueva');
                }
            }else{
                return redirect()->back()->with('error', 'La contraseña actual no coincide');
            }
        }

        return redirect()->back()->withInput();
    }

}