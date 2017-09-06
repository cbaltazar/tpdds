<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Empresa;
use App\Model\Entities\Metodologia;
use App\Model\Entities\Regla;
use App\Model\ORMConnections\EloquentConnection;
use App\Model\Utilities\MethodologyFilter;
use App\Model\Utilities\Validators\ValidateMethodology;
use App\Model\Domain\Rules\RuleASC;
use App\Model\Domain\Rules\RuleDEC;
use App\Model\Domain\Rules\RuleMAX;
use App\Model\Domain\Rules\RuleMIN;
use App\Model\Domain\Rules\RuleMINQ;
use App\Model\Domain\Rules\RuleMAXQ;
use Illuminate\Support\Facades\Auth;

class MethodologiesManager extends DomainManager
{
    private $ruleTypes = array(
        'asc'=>'Boolean',
        'dec'=>'Boolean',
        'minq'=>'Boolean',
        'maxq'=>'Boolean',
        'min'=>'Order',
        'max'=>'Order',
    );

    protected static $obj = null;

   private function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Metodologia::class;
        $this->validator = new ValidateMethodology();
        $this->validator->setOrm($this->ormConnection);
       $this->filter = new MethodologyFilter();
    }

    /*getInstance: devuelve la instancia de la clase.
     * */
    static function getInstance(){
        if(MethodologiesManager::$obj == null){
            MethodologiesManager::$obj = new MethodologiesManager(new EloquentConnection());
        }
        return MethodologiesManager::$obj;
    }

    public function deleteMessage()
    {
        $response = array();
        $response['msg'] = "Metodología borrada con éxito!";
        return $response;
    }

    public function saveElement($data, $id)
    {
        $methodology = null;
        if( $id != null){
            $methodology = $this->getOne($id);
        }else{
            $methodologyFactory = $this->getFactory(Metodologia::class);
            $methodology = $methodologyFactory->createObject();
        }
        $saved = $this->ormConnection->saveEntity($this->setValues($methodology, $data, $id));
        $this->saveRules( $saved, $data);
        return $saved;
    }

    public function saveRules($saved, $data){
        $ruleFactory = $this->getFactory(Regla::class);

        foreach ( $data->rules as $regla) {
            $rule = $ruleFactory->createObject();
            $rule->metodologia_id = $saved;
            $rule = $this->setRuleValues($rule, $regla);
            $this->ormConnection->saveEntity( $rule );
        }
    }

    public function saveMessage($saved)
    {
        $response = array();
        $response['msg'] = "Metodologia guardada con exito!";
        $response['id'] = $saved;
        if($saved == null) {
            $response['msg'] = "Error al guardar la metodologia.";
        }
        return $response;
    }

    public function deleteRelations($id)
    {
        $methodology = $this->getOne($id);
        $this->refreshMethodologyRules($methodology);
        return 1;
    }

    public function setRuleValues($rule, $data){
        $rule->elemento = $data->element;
        $rule->condicion = $data->condition;
        $rule->desde = $data->period->from;
        $rule->hasta = $data->period->to;
        $rule->modalidad = $data->mode;

        return $rule;
    }

    public function setValues($methodology, $data, $id){
        if($this->validateInput($data, $id)){
            if( $id != null){
                $this->refreshMethodologyRules($methodology);
            }
            $methodology->nombre = $data->name;
            $methodology->descripcion = $data->description;
            $methodology->activo = $data->status;
            $methodology->user_id = Auth::id();
            return $methodology;
        }
    }

    public function refreshMethodologyRules($methodology){
        $rules = $this->ormConnection->getWhere(Regla::class, 'metodologia_id', $methodology->id);
        foreach($rules as $rule){
            $this->ormConnection->deleteEntity(Regla::class, $rule->id);
        }
    }

    public function prepareArrayResults($params){
        $results = array();
        foreach ($params->companies as $company){
            $results[$company] = 0;
        }
        return $results;
    }

    public function orderResults($results){
        uasort($results, function($a, $b) {
            return $b - $a;
        });
        return $results;
    }

    public function addValoration($results){
        $results = $this->orderResults($results);
        $total = array_sum($results);
        foreach($results as $key => $value){
            if($total > 0){
                $results[$key] = round(($value*100)/$total, 2);
            }else{
                $results[$key] = 100;
            }

        }
        return $results;
    }

    public function getCompaniesNames($results){
        foreach ($results as $company => $value){
            $obj = $this->ormConnection->findById(Empresa::class, $company);
            $results[$obj->getNombre()] = $value;
            unset($results[$company]);
        }
        return $results;
    }

    public function orderRules($rules){
        $booleans = array();
        $orders = array();
        foreach ($rules as $key => $rule){
            if($this->ruleTypes[explode(',',$rule->condicion)[0]] == 'boolean'){
                array_push($booleans, $rule);
            }else{
                array_push($orders, $rule);
            }
        }
        return array_merge($booleans, $orders);
    }

    public function evaluate($params){
        $results = $this->prepareArrayResults($params);
        $methodology = $this->getOne($params->methodology);
        $rules = $this->orderRules($methodology->reglas);
        foreach ($rules as $rule){
            $ruleName = 'App\Model\Domain\Rules\\'.$this->ruleTypes[explode(",",$rule->condicion)[0]].'Rule';
            $objRule = new $ruleName();
            $results = $objRule->evaluate($results, $rule);
        }
        return $this->getCompaniesNames($this->addValoration($results));
    }
}