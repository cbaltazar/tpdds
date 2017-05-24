<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model implements FormulaElement
{
    public function getEmpresas(){
        return $this->belongsToMany(Empresa::class);
    }
}
