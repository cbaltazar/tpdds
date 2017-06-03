<?php

namespace App\Model\Factories\Domain\FormulaElements;

use App\Model\Domain\FormulaElements\AccountElement;

class AccountElementFactory extends FormulaElementFactory
{
    public function createObject($model){
        return new AccountElement($model);
    }
}