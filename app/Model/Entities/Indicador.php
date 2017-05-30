<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Indicador extends Model
{
    protected $table="indicadores";

    public function getId(){
        return $this->id;
    }

    public function isActive(){
        return $this->activo;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getElementosDeFormula(){
        return $this->elementosDeFormula;
    }

    public function getFormula(){
        return $this->formula;
    }
}
