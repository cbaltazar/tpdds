<?php

namespace App\Model\ORMConnections;

class EloquentConnection implements IORMConnection
{
    public function getAll($model){
        return $model::all();
    }

    public function findByColumnName($model, $columnName, $value){
        return $model::where($columnName, $value)->first();
    }

    public function findById($model, $id){
        return $model::find($id);
    }

    public function saveEntity($entity){
        $entity->save();
    }
}