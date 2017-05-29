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
    protected $domainManager;

    public abstract function getValue( $data );

    public function setDomainManager($dm){
        $this->domainManager = $dm;
    }

    public function getName(){
        return $this->model->getNombre();
    }

    public function getFormula(){
        return $this->model->getFormula();
    }

    public function setFormula($formula){
        return $this->model->formula = $formula;
    }

    public function getFormulaElementsIds(){
        return $this->model->getElementosDeFormula();
    }
}