<?php

namespace App\Model\Domain\Rules;

use App\Model\Domain\FormulaElements\AccountElement;
use App\Model\Domain\FormulaElements\IndicatorElement;
use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;
use App\Model\ORMConnections\EloquentConnection;

abstract class Rule
{
    public abstract function evaluate($results, $rule);

    public function applyMode($rule, $values){
        $total = array();
        $mode = $rule->modalidad;
        $total['total'] = $this->$mode($values);

        return $total;
    }

    public function addCompaniesValues($companies){
        $companiesSum = array();

        foreach($companies as $key=>$values){
            if(is_array($values)){
                $companiesSum[$key] = $this->sum($values);
            }else{
                $companiesSum[$key] = $values;
            }
        }
        return $companiesSum;
    }

    public function addPoints($companies, $results){
        $maxPoints = count((array)$companies);
        foreach( $companies as $key => $value){
            $results[$key]+= $maxPoints;
            $maxPoints--;
        }
        return $results;
    }

    public function sum($values){
        $result = 0;
        foreach($values as $key=>$term){
            $result+=$term;
        }
        return $result;
    }

    public function avg($values){
        $result = 0;
        foreach($values as $key=>$term){
            $result+=$term;
        }
        return $result/count($values);
    }

    public function med($values){

    }

    public function getValuesOfPeriods($companyId, $rule)
    {
        $element = $this->getElement($rule);
        $values = array();
        $data = new \stdClass();
        $data->company = $companyId;

        for ($i = $rule->desde; $i <= $rule->hasta; $i++) {
            $indicatorResult = new \stdClass();
            $data->period = $i;
            $values[$i] = $element->getValue($data);
        }
        if($rule->modalidad != 'uni'){
            $values = $this->applyMode($rule, $values);
        }
        return $values;
    }

    public function getElement($rule)
    {
        $element = null;
        if (explode(",", $rule->elemento)[1] == 'Cuenta') {
            $element = $this->getAccountElement($rule);
        } else {
            $element = $this->getIndicatorElement($rule);
        }

        $element->setOrmConnection($this->getOrmConnection());
        return $element;
    }

    public function getAccountElement($rule)
    {
        $model = Cuenta::find(explode(",", $rule->elemento)[0]);
        $element = new AccountElement();
        $element->setModel($model);
        return $element;
    }

    public function getIndicatorElement($rule)
    {
        $model = Indicador::find(explode(",", $rule->elemento)[0]);
        $element = new IndicatorElement();
        $element->setModel($model);
        return $element;
    }

    public function getOrmConnection()
    {
        return new EloquentConnection();
    }
}