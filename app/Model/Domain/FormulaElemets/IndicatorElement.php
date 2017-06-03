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

    /*Evaluar la formula y retornar el valor.*/
    public function getValue($data){
        //evalua la formula con el periodo y la empresa dada por parametro.
        return $this->evaluateFormula($data);
    }

    /*----------------------------------------------------------------------------------------------------------------*/
    public function evaluateFormula( $data ){
        //si el elemento tiene otros elementos dentro de su formula, tambien los evalua.
        if( !empty(json_decode($this->getFormulaElements())) ){
            $this->replaceFormulaElementValue($data);
        }
        //devuelve la evaluacion del string de formula.
        return round(eval('return '.$this->getFormula().';'), 2);
    }

    private function replaceFormulaElementValue($data){
        $formulaElements = json_decode($this->getFormulaElements());
        foreach ($formulaElements as $element){
            //creo la entidad a partir de los datos guardados en $elemento.
            $entity = $this->orm->findById('App\Model\Entities\\'.$element->class, $element->id);
            //camuflo la entidad con el elemento de formula
            $formulaElement = $this->getObjectFormulaElement($entity);
            //evaluo la formula del elemento actual
            if($formulaElement->getValue($data) >= 0){
                //si el valor de la formula existe, lo reemplazo en la formula del objeto que me llamo anteriormente.
                $this->setFormula(str_replace($formulaElement->getName(), $formulaElement->getValue($data), $this->getFormula()));
            }else{
                //si no existe elemento de formula, pongo un cero ya que no se puede calcular y corto el bucle.
                $this->setFormula(0);
                break;
            }
        }
    }
}