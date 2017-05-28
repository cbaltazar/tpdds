<?php

namespace App\Model\Factories\Domain\FormulaElements;

use App\Model\Domain\FormulaElements\IndicatorElement;

class IndicatorElementFactory extends FormulaElementFactory
{
    public function createObject($model, $dm){
        return new IndicatorElement($model, $dm);
    }
}