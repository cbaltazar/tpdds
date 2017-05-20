<?php

namespace App\Model;

use App\Model\ORMConnections\EloquentConnection;

class Domain
{
    private $ormConnection = null;
    private static $obj = null;

    function __construct($orm)
    {
        $this->ormConnection=$orm;
    }

    static function getInstance(){
        if(Domain::$obj == null){
            Domain::$obj = new Domain( new EloquentConnection(Empresa::class) );
        }

        return Domain::$obj;
    }

    public function getCompanies(){
        return $this->ormConnection->getAll();
    }

    public function getCompany($name){
        return $this->ormConnection->findByColumnName('nombre',$name);
    }
}