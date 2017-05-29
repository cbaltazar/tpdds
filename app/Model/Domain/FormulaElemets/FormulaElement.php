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
    protected $formula;

    public abstract function getValue( $data );

    public function setDomainManager($dm){
        $this->domainManager = $dm;
    }

    public function getName(){
        return $this->model->getNombre();
    }

    public function getFormula(){
        return $this->formula;
    }

    public function setFormula($formula){
        $this->formula = $formula;
    }

    public function getFormulaElementsIds(){
        return $this->model->getElementosDeFormula();
    }
}