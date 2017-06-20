<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Metodologia;
use App\Model\Entities\Regla;
use App\Model\ORMConnections\EloquentConnection;
use App\Model\Utilities\Validators\ValidateMethodology;

class MethodologiesManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Metodologia::class;
        $this->validator = new ValidateMethodology();
        $this->validator->setOrm($this->ormConnection);
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
        // TODO: Implement deleteMessage() method.
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
        // TODO: Implement deleteRelations() method.
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
            $methodology->nombre = $data->name;
            $methodology->descripcion = $data->description;
            $methodology->activo = $data->status;
            return $methodology;
        }
    }
}