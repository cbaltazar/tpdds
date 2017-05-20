<?php

namespace App\Model\ORMConnections;

use App\Model\Empresa;

class EloquentConnection
{
    private $model = null;

    function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll(){
        $model = $this->model;
        return $model::all();
    }

    public function findByColumnName($columnName, $value){
        $model = $this->model;
        return $model::where($columnName, $value)->first();
    }
}