<?php

namespace App\Model\Entities\Factories;

use App\Model\Entities\Cuenta;

class CuentaFactory extends EntityFactory
{
    public function createObject()
    {
        return new Cuenta();
    }
}