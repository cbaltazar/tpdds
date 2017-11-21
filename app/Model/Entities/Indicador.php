<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Indicador extends Model
{
    protected $table="indicadores";

    public $timestamps = false;

    public function getId(){
        return $this->id;
    }

    public function isActive(){
        return $this->activo;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getElementosDeFormula(){
        return $this->elementosDeFormula;
    }

    public function getFormula(){
        return $this->formula;
    }

    public function setActive($active){
        $this->activo = $active;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDescipcion($desc){
        $this->descripcion = $desc;
    }

    public function setElementosDeFormula($formulaElem){
        $this->elementosDeFormula = $formulaElem;
    }

    public function setFormula($formula){
        $this->formula = $formula;
    }

    public function visible(){
        return $this->predefinido == 1;
    }
}
