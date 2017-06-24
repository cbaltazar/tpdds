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

    public function applyMode($rule, $values){
        $mode = $rule->modalidad;
        return $this->$mode();
    }

    public function addCompaniesValues($companies){
        $companiesSum = array();
        foreach($companies as $key=>$values){
            $companiesSum[$key] = $this->sum($values);
        }
        return $companiesSum;
    }

    public function addPoints($companies){
        $companiesWithPoints = array();

        $maxPoints = count((array)$companies);
        foreach( $companies as $key => $value){
            $companiesWithPoints[$key] = $maxPoints;
            $maxPoints--;
        }

        return $companiesWithPoints;
    }

    public function sum($values){
        $result = 0;
        foreach($values as $key=>$term){
            $result+=$term;
        }
        return $result;
    }

    public function avg($values){

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