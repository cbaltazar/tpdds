<?php

namespace App\Model\Domain;

use App\Model\ORMConnections\EloquentConnection;

abstract class Domain
{
    protected $ormConnection = null;

    static abstract function getInstance();

    public function getObject($type, $name){
        $object = $this->ormConnection->findByColumnName($type,'nombre',$name);
        if (!$object){
            $object = new $type();
            $object->nombre = $name;
            $this->ormConnection->saveEntity($object);
        }
        return $object;
    }
}