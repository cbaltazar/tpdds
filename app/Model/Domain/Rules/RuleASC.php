<?php

namespace App\Model\Domain\Rules;


class RuleASC extends Rule
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
        foreach ($partialResult as $key => $value){
            if(isset($partialResult[$key+1]) && $value > $partialResult[$key+1] ){
                $response = false;
                break;
            }
        }
        return $response;
    }
}