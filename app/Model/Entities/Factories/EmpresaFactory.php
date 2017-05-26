<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 26/05/17
 * Time: 12:46
 */

namespace App\Model\Entities\Factories;

use App\Model\Entities\Empresa;


class EmpresaFactory extends EntityFactory
{
    public function createObject()
    {
        return new Empresa();
    }
}