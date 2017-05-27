<?php

namespace App\Model\Domain\FormulaElements;


use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;

abstract class FormulaElement
{
    protected $model;
    protected $domainManager;

    public abstract function getValue( $data );

    public function getName(){
        return $this->model->nombre;
    }

    public function getFormula(){
        return $this->model->formula;
    }

    public function getFormulaElementsNames(){
        return $this->model->elementosDeFormula;
    }

    public function setFormula($formula){
        $this->model->formula = $formula;
    }

    public function setDomainManager($dm){
        $this->domainManager = $dm;
    }

    public static function getElement( $entity )
    {
        switch ( get_class($entity) ){
            case 'App\Model\Entities\Cuenta':
                return new AccountElement($entity, AccountCompanyRelationManager::getInstance());
                break;
            default:
                return new IndicatorElement($entity, IndicatorsManager::getInstance());
        }
    }
}