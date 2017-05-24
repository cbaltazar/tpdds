<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model implements FormulaElement
{
    protected $table="indicadores";

    public function evaluateFormula( $data ){
        $elementos = explode(",",$this->elementosDeFormula);

        foreach ($elementos as $elemento){
            $elemento = str_replace("_", " ", $elemento);
            $elem = $this->getElement($elemento);
            $this->formula = str_replace($elemento, $elem->getValue($data), $this->formula);
        }

        return eval('return '.$this->formula.';');
    }

    public function getValue($data){
        return $this->evaluateFormula($data);
    }

    //SACAR FUNCION A UNA CLASE. NO ES RESPONSABILIDAD DEL INDICADOR, DECIDIR DE QUE CLASE ES EL ELEMENTO.
    public function getElement($e){
        $retorno = Cuenta::where('nombre', $e)->first();
        if(!$retorno){
            $retorno = Indicador::where('nombre', $e)->first();
        }

        return $retorno;
    }
}
