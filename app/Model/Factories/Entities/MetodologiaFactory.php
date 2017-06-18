<?php

namespace App\Model\Factories\Entities;

use App\Model\Entities\Metodologia;

class MetodologiaFactory extends EntityFactory
{
    public function createObject(){
        return new Metodologia();
    }
}