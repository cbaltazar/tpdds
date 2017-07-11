<?php

/*
 * AccountCompanyRelationManager: se encarga de manejar la tabla de relaciones cuenta-empresa.
 * */

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Cuenta_Empresa;
use App\Model\ORMConnections\EloquentConnection;

class AccountCompanyRelationManager extends DomainManager
{
    protected static $obj = null;

    private function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Cuenta_Empresa::class;
    }

    static function getInstance(){
        if(AccountCompanyRelationManager::$obj == null){
            AccountCompanyRelationManager::$obj = new AccountCompanyRelationManager(new EloquentConnection());
        }
        return AccountCompanyRelationManager::$obj;
    }

    function deleteRelations($id){}

    function deleteMessage(){}

    function saveElement($data, $id){}

    function saveMessage($saved){}

}