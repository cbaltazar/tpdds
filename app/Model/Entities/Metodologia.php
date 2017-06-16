<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Metodologia extends Model
{
    public function getRules(){
        return $this->hasMany( Regla::class );
    }
}
