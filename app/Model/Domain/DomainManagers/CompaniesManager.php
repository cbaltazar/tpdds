<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;

class CompaniesManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Empresa::class;
    }

    static function getInstance(){
        if(CompaniesManager::$obj == null){
            CompaniesManager::$obj = new CompaniesManager(new EloquentConnection());
        }
        return CompaniesManager::$obj;
    }

    public function deleteRelations($id)
    {
        $relations = $this->ormConnection->findAllByColumnName(Cuenta_Empresa::class,'empresa_id', $id);
        foreach ($relations as $relation){
            $this->ormConnection->deleteEntity(Cuenta_Empresa::class, $relation->id);
        }
    }

    public function deleteMessage()
    {
        return "Empresa borrada con exito!";
    }

    public function saveElement($data, $id){}

    public function saveMessage(){}
}