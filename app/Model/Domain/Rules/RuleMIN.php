<?php

namespace App\Model\Domain\Rules;


class RuleMIN extends Rule
{
    public function evaluate($results, $params, $rule)
    {
        $indicatorResults = array();
        foreach ($params->companies as $key => $companyId){
            $indicatorResults[] = $this->getValuesOfPeriods($companyId, $rule);
        }
        var_dump( $this->order($indicatorResults) ); die;
        return $this->order($partialResults);
    }

    public function order( $companies ){
        $companiesSum = $this->addCompaniesValues($companies);
        uasort($companiesSum, function($a, $b) {
            return $a - $b;
        });
        return $this->addPoints($companiesSum);
    }

}