<?php

namespace App\Model\Domain\Rules;

class RuleMINQ extends Rule
{
    public function evaluate($results, $rule)
    {
        $companies = $results;
        $indicatorResults = array();
        foreach ($companies as $companyId => $value){
            $indicatorResults[$companyId] = $this->getValuesOfPeriods($companyId, $rule);
        }
        return $this->applyCondition($indicatorResults, $results,$rule);
    }

    public function applyCondition($indicatorResults, $results,$rule){
        foreach ($indicatorResults as $key => $partialResult){
            if(!$this->compareValues($partialResult, $rule)){
                unset($results[$key]);
            }
        }
        return $results;
    }

    public function compareValues($partialResult, $rule){
        $response = true;
        foreach ($partialResult as $partial){
            if($partial > explode(",",$rule->condicion)[1]){
                $response = false;
            }
        }
        return $response;
    }
}