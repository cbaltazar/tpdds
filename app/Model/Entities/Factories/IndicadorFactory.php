<?php

namespace App\Model\Entities\Factories;

use App\Model\Entities\Indicador;

class IndicadorFactory extends EntityFactory
{
    public function createObject(){
        return new Indicador();
    }
}