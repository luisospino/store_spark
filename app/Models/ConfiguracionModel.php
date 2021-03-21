<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table      = 'configuracion';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre','rfc','telefono','correo','direccion','leyenda'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>