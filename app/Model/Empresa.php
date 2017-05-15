<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function getCuentas(){
        return $this->belongsToMany(Cuenta::class)->withPivot('periodo', 'monto');
    }
}
