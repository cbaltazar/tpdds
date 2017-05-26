<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;

abstract class DomainManager
{
    protected $ormConnection = null;
    protected $model = null;
    protected $fatoryPath = '\\App\\Model\\Entities\\Factories\\';

    abstract function deleteMessage();
    abstract function saveElement($data, $id);
    abstract function saveMessage();
    abstract function deleteRelations($id);

    public function getAll(){
        return $this->ormConnection->getAll( $this->model );
    }

    public function getOne($id){
        $obj = $this->ormConnection->findById( $this->model,$id);
        return $obj;
    }

    public function getWhere($where){
        return $obj = $this->ormConnection->findWhere( $this->model, $where);
    }

    public function save($data, $id){
        $this->saveElement($data, $id);
        return $this->saveMessage();
    }

    public function delete($id){
        $this->deleteRelations($id);
        $this->ormConnection->deleteEntity( $this->model, $id);
        return $this->deleteMessage();
    }

    public function getAvailablesElements(){
        $elements = $this->ormConnection->getAll( $this->model );
        $availablesElements = array();

        foreach ($elements as $element) {
            $obj = new \stdClass();
            $obj->id = $element->id;
            $obj->nombre = $element->nombre;
            array_push($availablesElements,$obj);
        }
        return $availablesElements;
    }

    public function getObject($type, $name){
        $object = $this->ormConnection->findByColumnName($type,'nombre',$name);
        if (!$object){
            $factory = $this->getFactory($type);
            $object = $factory->createObject();
            $object->nombre = $name;
            $this->ormConnection->saveEntity($object);
        }
        return $object;
    }

    public function getFromulaElement($id){
        $retorno = Cuenta::find($id);
        if(!$retorno){
            $retorno = Indicador::find($id);
        }
        return $retorno;
    }

    private function getFactory($type){
        $namespace = explode("\\", $type);
        $namespace[count($namespace)-1] = 'Factories\\'.$namespace[count($namespace)-1]."Factory";
        $factory = implode('\\', $namespace);

        return new $factory;
    }
}