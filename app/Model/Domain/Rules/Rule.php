<?php

namespace App\Model\Domain\Rules;

use App\Model\Domain\FormulaElements\AccountElement;
use App\Model\Domain\FormulaElements\IndicatorElement;
use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;
use App\Model\ORMConnections\EloquentConnection;

abstract class Rule
{
    public abstract function evaluate($results, $params, $rule);

    public function getValuesOfPeriods($results, $params, $rule){
        $results = array();
        foreach ($params->companies as $companyId){
            $element = $this->getElement($rule);
            $values = array();
            $data = new \stdClass();
            $data->company = $companyId;
            for($i = $rule->desde; $i <= $rule->hasta; $i++ ){
                $data->period = $i;
                $values[$i] = $element->getValue($data);
            }
            $results[$companyId] = $values;
        }

        return $results;
    }

    public function getElement($rule){
        $element = null;
        if( explode(",", $rule->elemento)[1] == 'Cuenta' ){
            $element = $this->getAccountElement($rule);
        }
        else{
            $element = $this->getIndicatorElement($rule);
        }

        $element->setOrmConnection($this->getOrmConnection());
        return $element;
    }

    public function getAccountElement($rule){
        $model = Cuenta::find( explode(",", $rule->elemento)[0] );
        $element = new AccountElement();
        $element->setModel($model);
        return $element;
    }

    public function getIndicatorElement($rule){
        $model = Indicador::find( explode(",", $rule->elemento)[0] );
        $element = new IndicatorElement();
        $element->setModel($model);
        return $element;
    }

    public function getOrmConnection(){
        return new EloquentConnection();
    }
}