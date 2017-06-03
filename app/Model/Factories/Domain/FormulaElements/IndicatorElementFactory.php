<?php

namespace App\Model\Factories\Domain\FormulaElements;

use App\Model\Domain\FormulaElements\IndicatorElement;

class IndicatorElementFactory extends FormulaElementFactory
{
    public function createObject(){
        return new IndicatorElement();
    }
}