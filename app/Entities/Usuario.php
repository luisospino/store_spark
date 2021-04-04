<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Usuario extends Entity
{
    protected $dates = ['fecha_alta'];//Conversión automática a Time() para usar humanize() por ejemplo

    protected $casts = [
        'flag' => 'boolean',//Casteo automático a true or false al hacer Get
        'colores' => 'csv'//Casteo de ['red', 'yellow', 'green'] a "rojo, amarillo, verde" al insertar en Database
    ];

    public function setClave(string $clave)//Conversion hashPassword
    {
        $this->attributes['clave'] = password_hash($clave, PASSWORD_BCRYPT);
        return $this;
    }

    public function getClave()
    {
        return $this->attributes['clave'];
    }

    public function setFlag($flag)
    {
        $this->attributes['flag'] = (boolean)$flag;
        return $this;
    }

    public function getFlag()
    {
        return $this->attributes['flag'];
    }  
    
    public function setFechaAlta($fecha)//OJO, Casi nunca se inserta una fecha como Just Now por ejemplo
    {
       $this->attributes['fecha_alta'] = $fecha->humanize();
       return $this;
    }

    public function getFechaAlta()
    {
        return $this->attributes['fecha_alta'];
    }
}