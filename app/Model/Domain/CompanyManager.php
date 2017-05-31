<?php

namespace App\Model\Domain;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;

class CompanyManager extends DomainManager
{
  /*  Este código se movio a DomainManager
  protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
    }

    public function getConnectionORM(){
        return $this->ormConnection;
    }

    static function getInstance(){
        if(AccountsManager::$obj == null){
            AccountsManager::$obj = new AccountsManager(new EloquentConnection());
        }
        return AccountsManager::$obj;
    }
*/
    //commit de prueba!!!
    function __construct($orm){
         $this->ormConnection=$orm;
     }
   public static function getInstance(){
    if(CompanyManager::$obj == null){
        CompanyManager::$obj = new CompanyManager(new EloquentConnection());
    }
    return CompanyManager::$obj;
   }
    public function getEntity($id){
        return $this->ormConnection->findById(Empresa::class,$id);
    }

    public function saveEntity($data){

      $empresa =  findByColName($type,$colName,$value)
            foreach ($data as $d) {
                $empresa = $this->getObject(Empresa::class, $d->company);
                $cuenta_empresa = new Cuenta_Empresa();
                $cuenta_empresa->cuenta_id = $cuenta->id;
                $cuenta_empresa->empresa_id = $empresa->id;
                $cuenta_empresa->periodo = $d->period;
                $cuenta_empresa->monto = $d->amount;
                $this->ormConnection->saveEntity($cuenta_empresa);
            }
    }
    public function deleteEntity($data)
    {

    }
    public function getAllEntities(){
        return $this->ormConnection->getAll(Empresa::class);
    }
    public function findByColName($colName,$value)
    {
    return  parent::findByColName(Empresa::class,$colName,$value)
    }
}
