<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model implements FormulaElement
{
    protected $table="indicadores";

    public function evaluateFormula(){
        $elementos = explode(",",$this->elementosDeFormula);
        echo "Formula: ".$this->formula."<br><br>";
        foreach ($elementos as $elemento){
            $elemento = str_replace("_", " ", $elemento);
            echo "Elemento encontrado: ".$elemento."<br><br>";
            $elem = $this->getElement($elemento);
            $this->formula = str_replace($elemento, $elem->getValue(), $this->formula);
            echo "Reemplazando, la formula queda: ".$this->formula."<br><br>";
        }

        return $this->formula;
    }

    public function getValue(){
        return $this->evaluateFormula();
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
