<?php

namespace App\Model\Factories\Entities;

use App\Model\Entities\Cuenta;

class CuentaFactory extends EntityFactory
{
    public function createObject()
    {
        return new Cuenta();
    }
}