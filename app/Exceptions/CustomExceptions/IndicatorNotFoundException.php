<?php

namespace App\Exceptions\CustomExceptions;

class IndicatorNotFoundException extends Exception
{
    public function getMessage(){
        return "Error en la formula cargada.";
    }
}