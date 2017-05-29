<?php

namespace App\Model\ORMConnections;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;

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

    public function findWhere($model, $where){
        return $model::where($where)->first();
    }

    public function getDistinct($model, $column){
       return $model::distinct()->get([$column]);
    }

    public function saveEntity($entity){
        return $entity->save();
    }

    public function deleteEntity($model, $id){
        $entity = $model::find($id);
        return $entity->delete();
    }

    public function findFormulaElementEntity($id){
        $retorno = Cuenta::find($id);
        if(!$retorno){
            $retorno = Indicador::find($id);
        }
        return $retorno;
    }
}
