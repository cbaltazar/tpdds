<?php

namespace App\Model\Entities\Factories;

use App\Model\Entities\Cuenta;

class AccountFactory extends EntityFactory
{
    public function createObject()
    {
        return new Cuenta();
    }
}