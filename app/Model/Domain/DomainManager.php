<?php

namespace App\Model\Domain;

use App\Model\ORMConnections\EloquentConnection;

abstract class DomainManager
{
    protected $ormConnection = null;
    protected static $obj = null;

    public function getConnectionORM(){
          return $this->ormConnection;
    }

    public  static function getInstance(){
          if(DomainManager::$obj == null){
              DomainManager::$obj = new DomainManager(new EloquentConnection());
          }
          return DomainManager::$obj;
      }
  //  public static abstract function getInstance();
    public function getObject($type, $name){

    }
    public function updateEntity($data,$id)
    {

    }
    public function save($data)
    {
       $this->ormConnection->saveEntity( $this->saveEntity($data));
        return "Guardado con exito!";
    }
/*    public function getById2 ($type, $id)
    {
      return  $this->ormConnection->findById($type, $id);
    }
    public function getByid($id)
    {
    return  $this->getEntity($id);
    }*/
    public abstract function getEntity($data);
    public abstract function saveEntity($data);
    public abstract function deleteEntity($data);
    public abstract function getAllEntities();
    public function findByColName($type,$colName,$value)
    {
      $object = $this->ormConnection->findByColumnName($type,$colName,$value);
    /*  if (!$object){
          $object = new $type();
          $object->nombre = $value;
          $this->ormConnection->saveEntity($object);
      }*/
      return $object;
    }
}
