<?php

namespace App\Model\Factories\Entities;

use App\Model\Entities\Empresa;


class EmpresaFactory extends EntityFactory
{
    public function createObject()
    {
        return new Empresa();
    }
}