<?php

namespace App\Model\ORMConnections;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;
use Illuminate\Support\Facades\Auth;

class EloquentConnection implements IORMConnection
{
    public function getAll($model){
        return $model::where('user_id', Auth::id())->get();
    }

    public function findByColumnName($model, $columnName, $value){
        return $model::where($columnName, $value)->where('user_id', Auth::id())->first();
    }

    public function findAllByColumnName($model, $columnName, $value){
        return $model::where($columnName, $value)->where('user_id', Auth::id())->get();
    }

    public function findById($model, $id){
        return $model::find($id);
    }

    public function findWhere($model, $where){
        return $model::where($where)->where('user_id', Auth::id())->first();
    }

    public function getDistinct($model, $column){
       return $model::distinct()->get([$column]);
    }

    public function countWhere($model, $columnName, $value){
        return $model::where($columnName, $value)->where('user_id', Auth::id())->count();
    }

    public function getWhere($model, $columnName, $value){
        return $model::where($columnName, $value)->where('user_id', Auth::id())->get();
    }

    public function saveEntity($entity){
        $entity->save();
        return $entity->id;
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
