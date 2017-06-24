<?php

namespace App\Model\Domain\Rules;

class RuleMINQ extends Rule
{
    public function evaluate($results, $params, $rule)
    {
        foreach ($params->companies as $companyId){
            $valueOfPeriods = $this->getValuesOfPeriods($companyId, $rule);
            if( $rule->modalidad != 'uni' ){ //tengo un solo registro y lo comparo contra el valor.
               $valueOfPeriods =  $this->applyMode($rule, $valueOfPeriods);
            }
            /*si es uni, no hago nada.
            despues le paso el valueOfPriods a una funcion que compare contra el valor y devuelvo falso y alguno no cumple. descarto la empresa */

        }
    }
}