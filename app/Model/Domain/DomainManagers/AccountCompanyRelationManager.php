<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 5/25/2017
 * Time: 2:07 AM
 */

namespace App\Model\Domain\DomainManagers;


use App\Model\Entities\Cuenta_Empresa;
use App\Model\ORMConnections\EloquentConnection;

class AccountCompanyRelationManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
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

    function saveMessage(){}

}