<?php

namespace App\Model\Domain\Rules;


class BooleanRule extends Rule
{
    public function applyCondition($indicatorResults, $results, $rule){
        $conditionName = 'compare'.strtoupper(explode(",",$rule->condicion)[0]).'Values';
        foreach ($indicatorResults as $key => $partialResult){
            if(!$this->$conditionName($partialResult, $rule)){
                unset($results[$key]);
            }
        }
        return $results;
    }

    public function compareASC($partialResult, $rule){
        $response = true;
        foreach ($partialResult as $key => $value){
            if(isset($partialResult[$key+1]) && $value > $partialResult[$key+1] ){
                $response = false;
                break;
            }
        }
        return $response;
    }

    public function compareDECValues($partialResult, $rule){
        $response = true;
        foreach ($partialResult as $key => $value){
            if(isset($partialResult[$key+1]) && $value < $partialResult[$key+1] ){
                $response = false;
                break;
            }
        }
        return $response;
    }

    public function compareMAXQValues($partialResult, $rule){
        $response = true;
        foreach ($partialResult as $partial){
            if($partial < explode(",",$rule->condicion)[1]){
                $response = false;
            }
        }
        return $response;
    }

    public function compareMINQValues($partialResult, $rule){
        $response = true;
        foreach ($partialResult as $partial){
            if($partial > explode(",",$rule->condicion)[1]){
                $response = false;
            }
        }
        return $response;
    }
}