<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cuenta_Empresa extends Model
{
    protected $table='cuenta_empresa';

    public function empresa(){
        return $this->hasOne(Empresa::class, 'id', 'empresa_id');
    }

    public function cuenta(){
        return $this->hasOne(Cuenta::class, 'id', 'cuenta_id');
    }
}
