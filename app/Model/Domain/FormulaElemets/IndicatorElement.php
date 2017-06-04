<?php

/*
 * AccountElement: maneja el elemento de formula, cuando este es un Indicador. Devuelve la formula
 * Implementa el patron Composite.
 * */

namespace App\Model\Domain\FormulaElements;

class IndicatorElement extends FormulaElement
{
    public function getValue($data){
        return $this->evaluateFormula($data);
    }

    /*----------------------------------------------------------------------------------------------------------------*/
    public function evaluateFormula( $data ){
        if( !empty(json_decode($this->getFormulaElements())) ){
            $this->replaceFormulaElementValue($data);
        }
        return round(eval('return '.$this->getFormula().';'), 2);
    }

    private function replaceFormulaElementValue($data){
        $formulaElements = json_decode($this->getFormulaElements());
        foreach ($formulaElements as $element){
            $entity = $this->orm->findById('App\Model\Entities\\'.$element->class, $element->id);
            $formulaElement = $this->getObjectFormulaElement($entity);
            $formulaElement->setOrmConnection($this->orm);
            $formulaElement->setModel($entity);

            if($formulaElement->getValue($data) >= 0){
                $this->setFormula(str_replace($formulaElement->getName(), $formulaElement->getValue($data), $this->getFormula()));
            }else{
                $this->setFormula(0);
                break;
            }
        }
    }
}