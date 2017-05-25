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

    public function findAllByColumnName($model, $columnName, $value){
        return $model::where($columnName, $value)->get();
    }

    public function findById($model, $id){
        return $model::find($id);
    }

    public function saveEntity($entity){
        $entity->save();
    }

    public function deleteEntity($model, $id){
        $entity = $model::find($id);
        $entity->delete();
    }
}