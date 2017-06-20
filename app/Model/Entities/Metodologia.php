<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Metodologia extends Model
{
    public function reglas(){
        return $this->hasMany( Regla::class, 'metodologia_id', 'id');
    }
}
