<?php

namespace App\Model\Utilities\Validators;

use App\Model\Entities\Indicador;
use Illuminate\Support\Facades\Auth;

abstract class Validator
{
    protected $orm;

    public abstract function validateParams($params, $id);

    public function setOrm($orm){
        $this->orm = $orm;
    }

    public function getOrm(){
        return $this->orm;
    }

    public function validateFormatName($name){
        $response = true;
        if(!preg_match('/^([ 0-9A-Za-z-_])+$/', $name)){
            $response = false;
        }
        return $response;
    }

    public function existName($model, $name){
        $response = false;
        $elem = $this->orm->findByColumnName($model,'nombre', $name);

        if( $model == Indicador::class){
            $where = array();

            $nombre = ['nombre', '=', $name];
            $userid = ['user_id', '=', Auth::id()];

            array_push($where, $nombre);
            array_push($where, $userid);

            $elem = $this->orm->findWhere($model, $where);
        }

        if($elem != null){
            $response = true;
        }
        return $response;
    }

}