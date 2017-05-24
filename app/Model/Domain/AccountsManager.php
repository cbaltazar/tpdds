<?php

namespace App\Model\Domain;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;

class AccountsManager extends DomainManager
{
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

    public function getCompanies(){
        return $this->ormConnection->getAll(Empresa::class);
    }

    public function getCompany($id){
        return $this->ormConnection->findById(Empresa::class,$id);
    }

    public function getAvailablesAccounts(){
        $accounts = $this->ormConnection->getAll(Cuenta::class);
        $availablesAccounts = array();
        foreach ($accounts as $account) {
            array_push($availablesAccounts,$account->nombre);
        }
        return $availablesAccounts;
    }

    public function getAccounts(){
        $empresas = $this->ormConnection->getAll(Cuenta_Empresa::class);
        $accountList = array();
        foreach ($empresas as $empresa){
            $e = new \stdClass();
            $e->nombreEmpresa = $this->ormConnection->findById(Empresa::class, $empresa->empresa_id)->nombre;
            $e->nombreCuenta = $this->ormConnection->findById(Cuenta::class, $empresa->cuenta_id)->nombre;
            $e->periodo = $empresa->periodo;
            $e->monto = $empresa->monto;

            array_push($accountList, $e);
        }
        return $accountList;
    }

    public function saveAccounts($data){
            foreach ($data as $d) {
                $empresa = $this->getObject(Empresa::class, $d->company);
                $cuenta = $this->getObject(Cuenta::class, $d->account);

                $cuenta_empresa = new Cuenta_Empresa();
                $cuenta_empresa->cuenta_id = $cuenta->id;
                $cuenta_empresa->empresa_id = $empresa->id;
                $cuenta_empresa->periodo = $d->period;
                $cuenta_empresa->monto = $d->amount;
                $this->ormConnection->saveEntity($cuenta_empresa);
            }
    }
}