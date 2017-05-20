<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    public function getEmpresas(){
        return $this->belongsToMany(Empresa::class);
    }
}
