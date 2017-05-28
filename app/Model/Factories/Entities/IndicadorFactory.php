<?php

namespace App\Model\Factories\Entities;

use App\Model\Entities\Indicador;

class IndicadorFactory extends EntityFactory
{
    public function createObject(){
        return new Indicador();
    }
}