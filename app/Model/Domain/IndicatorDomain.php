<?php

namespace App\Model\Domain;

use App\Model\Entities\Indicador;
use App\Model\ORMConnections\EloquentConnection;

class IndicatorDomain extends Domain
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
    }

    static function getInstance(){
        if(IndicatorDomain::$obj == null){
            IndicatorDomain::$obj = new IndicatorDomain(new EloquentConnection());
        }
        return IndicatorDomain::$obj;
    }

    public function saveIndicator($data){
        $indicator = new Indicador();
        $indicator->nombre = $data->input('name');
        $indicator->descripcion = $data->input('description');
        is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
        $indicator->formula = $data->input('formula');
        $indicator->elementosDeFormula = $data->formulaElements;
        
        $this->ormConnection->saveEntity($indicator);
    }

    public function getAvailablesIndicators(){
        $indicators = $this->ormConnection->getAll(Indicador::class);
        $availablesIndicators = array();
        foreach ($indicators as $indicator) {
            array_push($availablesIndicators,$indicator->nombre);
        }
        return $availablesIndicators;
    }
}