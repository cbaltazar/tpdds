<?php

namespace App\Model\Domain\Rules;

class RuleMINQ extends Rule
{
    public function evaluate($results, $params, $rule)
    {
            var_dump($this->getValuesOfPeriods($results, $params, $rule));die;
    }
}