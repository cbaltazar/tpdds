<?php

namespace App\Model\Domain\FormulaElements;

use App\Model\Domain\DomainManagers\DomainManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;

class IndicatorElement extends FormulaElement
{
    function __construct($indicator)
    {
        $this->model = $indicator;
    }

    public function evaluateFormula( $data ){
        $elementos = explode(",",$this->getFormulaElements());
        foreach ($elementos as $elemento){
            $elem = FormulaElement::getElement( IndicatorsManager::getInstance()->getFromulaElement($elemento) );
            if($elem->getValue($data) >= 0){
                $this->setFormula(str_replace($elem->getName(), $elem->getValue($data), $this->getFormula()));
            }else{
                $this->setFormula(0);
                break;
            }
        }
        return round(eval('return '.$this->getFormula().';'), 2);
    }

    public function getValue($data){
        return $this->evaluateFormula($data);
    }
}