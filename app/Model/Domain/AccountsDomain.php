<?php

namespace App\Model\Domain;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;

class AccountsDomain
{
    private $ormConnection = null;
    private static $obj = null;

    function __construct($orm)
    {
        $this->ormConnection=$orm;
    }

    static function getInstance(){
        if(AccountsDomain::$obj == null){
            AccountsDomain::$obj = new AccountsDomain(new EloquentConnection());
        }
        return AccountsDomain::$obj;
    }

    public function getCompanies(){
        return $this->ormConnection->getAll(Empresa::class);
    }

    public function getCompany($name){
        return $this->ormConnection->findByColumnName(Empresa::class,'nombre',$name);
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
                $empresa = $this->getObject('App\Model\Entities\Empresa', $d->company);
                $cuenta = $this->getObject('App\Model\Entities\Cuenta', $d->account);

                $cuenta_empresa = new Cuenta_Empresa();
                $cuenta_empresa->cuenta_id = $cuenta->id;
                $cuenta_empresa->empresa_id = $empresa->id;
                $cuenta_empresa->periodo = $d->period;
                $cuenta_empresa->monto = $d->amount;
                $this->ormConnection->saveEntity($cuenta_empresa);
            }
    }

    public function getObject($type, $name){
        $object = $type::where('nombre', $name)->first();
        if (!$object){
            $object = new $type();
            $object->nombre = $name;
            $this->ormConnection->saveEntity($object);
        }
        return $object;
    }
}