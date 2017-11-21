<?php

namespace App\Model\ORMConnections;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;
use Illuminate\Support\Facades\Auth;

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
        var_dump("Model: ", $model, "Where:", $where);
        $res = $model::where($where)->first();
        var_dump($res);
        return $res;
    }
    public function getDistinct($model, $column){
        return $model::distinct()->get([$column]);
    }
    public function countWhere($model, $columnName, $value){
        return $model::where($columnName, $value)->count();
    }
    public function getWhere($model, $columnName, $value){
        return $model::where($columnName, $value)->get();
    }
    public function saveEntity($entity){
        try{
            $entity->save();
        }catch(\Exception $e){
            var_dump( $e->getMessage() );
            die;
        }

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
