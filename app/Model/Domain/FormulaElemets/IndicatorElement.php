<?php

/*
 * AccountElement: maneja el elemento de formula, cuando este es un Indicador. Devuelve la formula
 * Implementa el patron Composite.
 * */

namespace App\Model\Domain\FormulaElements;

class IndicatorElement extends FormulaElement
{
    function __construct($indicator, $dm)
    {
        $this->model = $indicator;
        $this->domainManager = $dm;
        $this->formula = $this->model->getFormula();
    }

    public function evaluateFormula( $data ){
        if($this->getFormulaElementsIds()){
            $this->replaceFormulaElementValue($data);
        }
        return round(eval('return '.$this->getFormula().';'), 2);
    }

    public function getValue($data){
        return $this->evaluateFormula($data);
    }

    private function replaceFormulaElementValue($data){
        $elementos = explode(",",$this->getFormulaElementsIds());

        foreach ($elementos as $elemento){
            $entityFormulaElement = $this->domainManager->getFromulaElement($elemento);
            $elem = $this->domainManager->getObjectFormulaElement($entityFormulaElement);
            if($elem->getValue($data) >= 0){
                $this->setFormula(str_replace($elem->getName(), $elem->getValue($data), $this->getFormula()));
            }else{
                $this->setFormula(0);
                break;
            }
        }
    }
}