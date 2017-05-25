<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Cuenta extends Model
{
    public function getEmpresas(){
        return $this->belongsToMany(Empresa::class);
    }
}
