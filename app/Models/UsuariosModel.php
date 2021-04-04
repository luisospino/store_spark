<?php

namespace App\Models;

use CodeIgniter\Model;
//use App\Entities\Usuario; //Agregando entidad

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    //protected $returnType     = 'Usuario::class';  //Para retornar objetos de tipo Entidad Usuario
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuario','clave','nombre','id_caja','id_rol','activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>