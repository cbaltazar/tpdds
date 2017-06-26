<?php

namespace App\Model\Domain\Rules;


class OrderRule extends Rule
{
    public function applyCondition($companies, $results,$rule){
        $companiesSum = $this->addCompaniesValues($companies);
        $conditionMethod = 'order'.strtoupper($rule->condicion);
        $companiesSum = $this->$conditionMethod($companiesSum);
        return $this->addPoints($companiesSum, $results);
    }

    public function orderMIN($companies){
        uasort($companies, function ($a, $b){
            return $a - $b;
        });
        return $companies;
    }

    public function orderMAX($companies){
        uasort($companies, function ($a, $b){
            return $b -$a;
        });
        return $companies;
    }

}