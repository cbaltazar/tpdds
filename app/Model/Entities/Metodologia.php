<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Metodologia extends Model
{
    public $timestamps = false;

    public function reglas(){
        return $this->hasMany( Regla::class, 'metodologia_id', 'id');
    }

    public function visible(){
        return false;
    }
}
