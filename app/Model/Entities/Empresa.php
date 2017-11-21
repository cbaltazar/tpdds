<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    public $timestamps = false;

    public function cuentas(){
        return $this->belongsToMany(Cuenta::class)->withPivot('periodo', 'monto');
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
}
