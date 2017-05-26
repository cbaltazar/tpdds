<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Domain\FormulaElements\IndicatorElement;
use App\Model\Entities\Indicador;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;
use Illuminate\Validation\Rules\In;
use App\Model\Entities\Factories\IndicatorFactory;

class IndicatorsManager extends DomainManager
{
    protected static $obj = null;
    protected $model;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Indicador::class;
    }

    static function getInstance(){
        if(IndicatorsManager::$obj == null){
            IndicatorsManager::$obj = new IndicatorsManager(new EloquentConnection());
        }
        return IndicatorsManager::$obj;
    }


    public function saveElement($data, $id){
        $indicator = null;
        if( $id != null){
            $indicator = $this->getIndicator($id);
        }else{
            $indicatorFactory = new IndicatorFactory();
            $indicator = $indicatorFactory->createObject();
        }

        $indicator->nombre = $data->input('name');
        $indicator->descripcion = $data->input('description');
        is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
        $indicator->formula = $data->input('formula');
        $indicator->elementosDeFormula = $data->formulaElements;

        $this->ormConnection->saveEntity($indicator);

        return "Indicador cargado con exito!";
    }

    public function saveMessage()
    {
        return "Indicador guardado con exito!";
    }

    function deleteRelations($id){}

    public function deleteMessage(){}

    public function indicatorEvaluate($request){
        $indicators = $this->getAll();
        $results = array();

        foreach ($indicators as $indicator){
            $result = new \stdClass();
            $indicatorElement = new IndicatorElement($indicator);
            $empresa = $this->ormConnection->findById(Empresa::class, $request->input('company'));
            $result->company = $empresa->nombre;
            $result->indicator = $indicator->nombre;
            $result->period = $request->input('period');
            if($indicator->activo == 1){
                $result->value = $indicatorElement->evaluateFormula($request->input());
            }else{
                $result->value = 0;
            }

            array_push($results, $result);
        }

        return json_encode($results);
    }
}