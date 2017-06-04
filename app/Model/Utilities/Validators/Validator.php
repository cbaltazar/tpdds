<?php

namespace App\Model\Utilities\Validators;

abstract class Validator
{
    protected $orm;

    public abstract function validateParams($params);

    public function setOrm($orm){
        $this->orm = $orm;
    }

    public function getOrm(){
        return $this->orm;
    }

    public function validateFormatName($name){
        $response = true;
        if(!preg_match('/^([0-9A-Za-z-_])+$/', $name)){
            $response = false;
        }
        return $response;
    }

    public function existName($model, $name){
        $response = false;
        $elem = $this->orm->findByColumnName($model,'nombre', $name);
        if($elem != null){
            $response = true;
        }
        return $response;
    }

}