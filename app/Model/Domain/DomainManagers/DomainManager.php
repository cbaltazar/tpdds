<?php

namespace App\Model\Domain\DomainManagers;

abstract class DomainManager
{
    //Atributes
    protected $ormConnection = null;
    protected $model = null;

    //Templates methods.
    abstract function deleteMessage();
    abstract function saveElement($data, $id);
    abstract function saveMessage();
    abstract function deleteRelations($id);

    //Getters and Setters
    public function getOrmConnection(){
        return $this->ormConnection;
    }
    public function setOrmConnection($orm){
        $this->ormConnection = $orm;
    }

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

    public function getColumn($column){
        return $this->ormConnection->getDistinct($this->model, $column);
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
            $obj->id = $element->getId();
            $obj->nombre = $element->getNombre();
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
        return $this->ormConnection->findFormulaElementEntity($id);
    }

    private function getFactory($type){
        $namespace = explode("\\", $type);
        $namespace[count($namespace)-1] = 'Factories\\'.$namespace[count($namespace)-1]."Factory";
        $factory = implode('\\', $namespace);

        return new $factory;
    }
}