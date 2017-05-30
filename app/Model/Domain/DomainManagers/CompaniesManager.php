<?php

/*
 * Manager encargado del manejo de Cuentas.
 * Implementa el patron Singleton.
 * */

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

    /*getInstance: devuelve la instancia de la clase.
     * */
    static function getInstance(){
        if(CompaniesManager::$obj == null){
            CompaniesManager::$obj = new CompaniesManager(new EloquentConnection());
        }
        return CompaniesManager::$obj;
    }

    /* deleteRelations: busca la empresa pasada como parametro, y borra todas sus apariciones,
       en la tabla que relaciona cuentas y empresas.
     * */
    public function deleteRelations($id)
    {
        $relations = $this->ormConnection->findAllByColumnName(Cuenta_Empresa::class,'empresa_id', $id);
        foreach ($relations as $relation){
            $this->ormConnection->deleteEntity(Cuenta_Empresa::class, $relation->getId());
        }

        return 1;
    }

    /* deleteMessage: devuelve el mensaje luego de borrar la entidad.
     * */
    public function deleteMessage()
    {
        return "Empresa borrada con exito!";
    }

    public function saveElement($data, $id){}

    public function saveMessage($saved){}
}