<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'total', 'id_usuario', 'id_caja', 'id_cliente','id_metodo_pago', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>