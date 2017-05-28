<?php

namespace App\Model\Domain;

use App\Model\Entities\Indicador;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;
use Illuminate\Validation\Rules\In;

class IndicatorsManager extends DomainManager
{
    //  protected $ormConnection = null;
/*  Este código se movio a DomainManager
    protected static $obj = null;

   function __construct($orm){
        $this->ormConnection=$orm;
    }

    static function getInstance(){
        if(IndicatorsManager::$obj == null){
            IndicatorsManager::$obj = new IndicatorsManager(new EloquentConnection());
        }
        return IndicatorsManager::$obj;
    }*/
    function __construct($orm){
         $this->ormConnection=$orm;
     }
   public static function getInstance(){
    if(IndicatorsManager::$obj == null){
        IndicatorsManager::$obj = new IndicatorsManager(new EloquentConnection());
    }
    return IndicatorsManager::$obj;
   }
    public function getEntity($id){
    //    return parent::getById2(Indicador::class, $id);
    //    return  parent::getConnectionORM()->findById(Indicador::class, $id);
     var_dump (parent::getConnectionORM()->findById(Indicador::class, $id));
  }
    public function saveEntity($data){

        $indicator = new Indicador();
        $indicator->nombre = $data->input('name');
        $indicator->descripcion = $data->input('description');
        is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
        $indicator->formula = $data->input('formula');
        $indicator->elementosDeFormula = $data->formulaElements;
    //    $this->ormConnection->saveEntity($indicator);
        return $indicator;
    }

    public function deleteEntity($id){
        $this->ormConnection->deleteEntity(Indicador::class, $id);
        return "Indicador borrado con exito";
    }

    public function getAllEntities(){
        return $this->ormConnection->getAll(Indicador::class);
    }

    public function getAvailablesIndicators(){
        $indicators = $this->ormConnection->getAll(Indicador::class);
        $availablesIndicators = array();
        foreach ($indicators as $indicator) {
            array_push($availablesIndicators,$indicator->nombre);
        }
        return $availablesIndicators;
    }
    public function indicatorEvaluate($request){
        $indicators = $this->ormConnection->getAll(Indicador::class);
        $results = array();
        foreach ($indicators as $indicator){
            $result = new \stdClass();

            $empresa = $this->ormConnection->findById(Empresa::class, $request->input('company'));

            $result->company = $empresa->nombre;
            $result->indicator = $indicator->nombre;
            $result->period = $request->input('period');
            $result->value = $indicator->evaluateFormula( $request->input() );

            array_push($results, $result);
        }

        return json_encode($results);
    }
    public function updateEntity($data,$id){

          $indicator = $this->getIndicator($id);
          $indicator = new Indicador();
          $indicator->nombre = $data->input('name');
          $indicator->descripcion = $data->input('description');
          is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
          $indicator->formula = $data->input('formula');
          $indicator->elementosDeFormula = $data->formulaElements;

      //    $this->ormConnection->saveEntity($indicator);

          return "Indicador guadado con exito!";
    }
}
