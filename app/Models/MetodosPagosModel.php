<?php

namespace App\Models;

use CodeIgniter\Model;

class MetodosPagosModel extends Model
{
    protected $table      = 'metodo_pago';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>