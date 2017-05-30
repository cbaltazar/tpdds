<?php

namespace App\Model\Factories\Entities;

use App\Model\Entities\Cuenta_Empresa;

class Cuenta_EmpresaFactory extends EntityFactory
{
    public function createObject()
    {
        return new Cuenta_Empresa();
    }
}