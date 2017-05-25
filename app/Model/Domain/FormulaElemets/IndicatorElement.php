<?php

namespace App\Model\Domain\FormulaElements;

use App\Model\Domain\DomainManagers\DomainManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;

class IndicatorElement extends FormulaElement
{
    private $formula;
    private $elementosDeFormula;

    function __construct($indicator)
    {
        $this->formula = $indicator->formula;
        $this->elementosDeFormula = $indicator->elementosDeFormula;
    }

    public function evaluateFormula( $data ){
        $elementos = explode(",",$this->elementosDeFormula);

        foreach ($elementos as $elemento){
            $elemento = str_replace("_", " ", $elemento);
            $elem = FormulaElement::getElement( IndicatorsManager::getInstance()->getByName($elemento) );
            if($elem->getValue($data) >= 0){
                $this->formula = str_replace($elemento, $elem->getValue($data), $this->formula);
            }else{
                $this->formula = 0;
                break;
            }
        }

        return eval('return '.$this->formula.';');
    }

    public function getValue($data){
        return $this->evaluateFormula($data);
    }
}