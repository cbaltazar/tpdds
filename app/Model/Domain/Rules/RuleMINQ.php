<?php

namespace App\Model\Domain\Rules;

class RuleMINQ extends Rule
{
    public function evaluate($results, $params, $rule)
    {
        foreach ($params->companies as $companyId){
            $valueOfPeriods = $this->getValuesOfPeriods($companyId, $rule);
            if( $rule->modalidad != 'uni' ){
               $valueOfPeriods =  $this->applyMode($rule, $valueOfPeriods);
            }

        }
    }
}