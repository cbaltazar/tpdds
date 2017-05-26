<?php

namespace App\Model\Domain\FormulaElements;


abstract class FormulaElement
{
    protected $model;

    public abstract function getValue( $data );

    public function getName(){
        return $this->model->nombre;
    }

    public function getFormula(){
        return $this->model->formula;
    }

    public function setFormula($formula){
        $this->model->formula = $formula;
    }

    public function getFormulaElements(){
        return $this->model->elementosDeFormula;
    }

    public static function getElement( $entity )
    {
        switch ( get_class($entity) ){
            case 'App\Model\Entities\Cuenta':
                return new AccountElement($entity);
                break;
            default:
                return new IndicatorElement($entity);
        }
    }
}