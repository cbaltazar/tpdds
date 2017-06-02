<?php

/*
 * AccountElement: maneja el elemento de formula, cuando este es un Indicador. Devuelve la formula
 * Implementa el patron Composite.
 * */

namespace App\Model\Domain\FormulaElements;

use App\Model\ORMConnections\EloquentConnection;

class IndicatorElement extends FormulaElement
{
    function __construct($indicator)
    {
        $this->model = $indicator;
        $this->formula = $this->model->getFormula();
        $this->orm = new EloquentConnection();
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
        $elementos = json_decode($this->getFormulaElementsIds());

        foreach ($elementos as $elemento){
            $elemento = json_decode($elemento);
            $entityFormulaElement = $this->orm->findById('App\Model\Entities\\'.$elemento->class, $elemento->id);
            $elem = $this->getObjectFormulaElement($entityFormulaElement);
            if($elem->getValue($data) >= 0){
                $this->setFormula(str_replace($elem->getName(), $elem->getValue($data), $this->getFormula()));
            }else{
                $this->setFormula(0);
                break;
            }
        }
    }
}