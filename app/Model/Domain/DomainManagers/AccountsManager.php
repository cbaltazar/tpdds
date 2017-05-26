<?php

namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;
use Illuminate\Foundation\Console\EventMakeCommand;
use App\Model\Entities\Factories\AccountCompanyFactory;

class AccountsManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Cuenta::class;
    }

    static function getInstance(){
        if(AccountsManager::$obj == null){
            AccountsManager::$obj = new AccountsManager(new EloquentConnection());
        }
        return AccountsManager::$obj;
    }

    //Override
    public function getAll(){
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

    public function saveElement($data, $id=null){
            foreach ($data as $d) {
                $empresa = $this->getObject(Empresa::class, $d->company);
                $cuenta = $this->getObject(Cuenta::class, $d->account);
                $entityFactory = new AccountCompanyFactory();
                $cuenta_empresa = $entityFactory->createObject();
                $cuenta_empresa->cuenta_id = $cuenta->id;
                $cuenta_empresa->empresa_id = $empresa->id;
                $cuenta_empresa->periodo = $d->period;
                $cuenta_empresa->monto = $d->amount;
                $this->ormConnection->saveEntity($cuenta_empresa);
            }
    }

    public function saveMessage()
    {
        return "Cuentas actualizadas con exito!";
    }

    function deleteRelations($id){}

    public function deleteMessage()
    {
        return "Cuenta borrada con exito!";
    }
}