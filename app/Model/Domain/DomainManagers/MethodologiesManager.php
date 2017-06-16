<?php

namespace App\Model\Domain\DomainManagers;


use App\Model\Entities\Metodologia;
use App\Model\ORMConnections\EloquentConnection;

class MethodologiesManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Metodologia::class;
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
        var_dump( "data -> ", $data, " id -> ", $id );die;
        // TODO: Implement saveElement() method.
    }

    public function saveMessage($saved)
    {
        // TODO: Implement saveMessage() method.
    }

    public function deleteRelations($id)
    {
        // TODO: Implement deleteRelations() method.
    }

}