<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class EntityTemplate
{
    public function cuentas(){
        return $this->belongsToMany(Cuenta::class)->withPivot('periodo', 'monto');
    }
}
