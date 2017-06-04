<?php

/*
 * FormulaElement: clase abstracta para agrupar a los elementos que componen una formula,
 * que pueden ser Cuentas e Indicadores.
 *
 * */

namespace App\Model\Domain\FormulaElements;

use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;

abstract class FormulaElement
{
    protected $model;
    protected $formula;
    protected $orm;

    public abstract function getValue( $data );

    public function setFormula($formula){
        $this->formula = $formula;
    }

    public function setOrmConnection($orm){
        $this->orm=$orm;
    }

    public function setModel($model){
        $this->model = $model;
        $this->setFormula($model->getFormula());
    }

    public function getName(){
        return $this->model->getNombre();
    }

    public function getFormula(){
        return $this->formula;
    }

    public function getFormulaElements(){
        return $this->model->getElementosDeFormula();
    }

    /*getObjectFormulaElement: devuelve un objeto elemento de formula, para obtener su valor y reemplazarlo
    en la expresion.
     * */
    public function getObjectFormulaElement( $entity )
    {
        switch ( get_class($entity) ){
            case 'App\Model\Entities\Cuenta':
                return new AccountElement();
                break;
            default:
                return new IndicatorElement();
        }
    }
}