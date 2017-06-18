<?php

namespace App\Model\Utilities\Validators;

use Exception;
use App\Model\Entities\Metodologia;

class ValidateMethodology extends Validator
{
    public function validateParams($params, $id)
    {
        if(!$this->validateFormatName($params->name)){
            throw new Exception("Error en el nombre de la metodologia.");
        }

        if($this->existName(Metodologia::class, $params->name) && !$id){
            throw new Exception("Ya existe una metodologia con ese nombre.");
        }

        return true;
    }

}