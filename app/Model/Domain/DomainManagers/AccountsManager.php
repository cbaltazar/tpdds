<?php

/*
 * AccountsManager: se encarga del manejo de cuentas.
 * Implementa el patron Singleton.
 * */
namespace App\Model\Domain\DomainManagers;

use App\Model\Entities\Cuenta;
use App\Model\Entities\Cuenta_Empresa;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;
use App\Model\Entities\Factories\Cuenta_EmpresaFactory;

class AccountsManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Cuenta::class;
    }

    /*getInstance: devuelve la instancia de la clase.
     * */
    static function getInstance(){
        if(AccountsManager::$obj == null){
            AccountsManager::$obj = new AccountsManager(new EloquentConnection());
        }
        return AccountsManager::$obj;
    }

    /*
     * saveElement: guarda las cuentas que se cargan en el archivo. En la tabla de relaciones guarda
     * empresa, cuenta, monto y periodo, y en la tabla de cuentas, crea una nueva entidad.
     * */
    public function saveElement($data, $id=null){
            foreach ($data as $d) {
                $empresa = $this->getObject(Empresa::class, $d->company);
                $cuenta = $this->getObject(Cuenta::class, $d->account);
                $entityFactory = $this->getFactory(Cuenta_Empresa::class);
                $cuenta_empresa = $entityFactory->createObject();
                $cuenta_empresa->cuenta_id = $cuenta->getId();
                $cuenta_empresa->empresa_id = $empresa->getId();
                $cuenta_empresa->periodo = $d->period;
                $cuenta_empresa->monto = $d->amount;
                $this->ormConnection->saveEntity($cuenta_empresa);
            }
    }

    /* Devuelve el mensaje de guardado de cuentas.
     * */
    public function saveMessage()
    {
        return "Cuentas actualizadas con exito!";
    }

    /*se agrega debido a la herencia, pero no se implementa ya que este manager no lo necesita*/
    function deleteRelations($id){}

    /* Devuelve el mensaje de borrado de cuentas.
     * */
    public function deleteMessage()
    {
        return "Cuenta borrada con exito!";
    }
}