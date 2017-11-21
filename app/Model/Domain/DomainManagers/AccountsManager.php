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
use App\Model\Factories\Cuenta_EmpresaFactory;
use Illuminate\Support\Facades\Auth;

class AccountsManager extends DomainManager
{
    protected static $obj = null;

    private function __construct($orm){
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
                $this->saveAccountCompanyElement($d);
            }
            $this->addAntiquity();
            return 1;
    }

    public function addAntiquity(){
        $companies = Empresa::all();
        foreach ($companies as $company){
            $relations = Cuenta_Empresa::distinct()->where('empresa_id', $company->id)->pluck('periodo')->toArray();
            $antiquity = 1;
            if(count($relations) > 1){
                $antiquity = $relations[count($relations)-1] - $relations[0];
            }
            $company->antiguedad = $antiquity;
            $company->save();
        }
        return 1;
    }

    private function getConditions($data){
        var_dump("WHERE");
        $empresa = $this->getObject(Empresa::class, $data->company);
        $cuenta = $this->getObject(Cuenta::class, $data->account);
        var_dump("WHEREeeeeeeeeeeeeee");
        $where = array();

        $account_id = ['cuenta_id', '=', $cuenta->getId()];
        $company_id = ['empresa_id', '=', $empresa->getId()];
        $period = ['periodo', '=', $data->period];

        array_push($where, $account_id);
        array_push($where, $company_id);
        array_push($where, $period);


        var_dump($where);

        return $where;
    }

    private function existRow($d){
        var_dump("Conection");
        var_dump($this->ormConnection);
        var_dump( Cuenta_Empresa::where($this->getConditions($d))->first());
        var_dump("EndConnection");
        if( $this->ormConnection->findWhere(Cuenta_Empresa::class, $this->getConditions($d)) ){
            return true;
        }else{
            return false;
        }

    }

    private function updateRow($data){
        $entity = $this->ormConnection->findWhere(Cuenta_Empresa::class, $this->getConditions($data));
        $entity->setMonto($data->amount);
        $this->ormConnection->saveEntity($entity);
        return $entity;
    }

    private function saveNewData($d){
        var_dump("NEW DATA");
        $empresa = $this->getObject(Empresa::class, $d->company);
        $cuenta = $this->getObject(Cuenta::class, $d->account);
        $entityFactory = $this->getFactory(Cuenta_Empresa::class);
        $cuenta_empresa = $entityFactory->createObject();
        $cuenta_empresa->setCuentaId($cuenta->getId());
        $cuenta_empresa->setEmpresaId($empresa->getId());
        $cuenta_empresa->setPeriodo($d->period);
        $cuenta_empresa->setMonto($d->amount);

        $saved = $this->ormConnection->saveEntity($cuenta_empresa);

        return $cuenta_empresa;
    }

    public function saveAccountCompanyElement($d){
        $response = null;
        if( $this->existRow($d) ){
            $response = $this->updateRow($d);
        }else{
            $response = $this->saveNewData($d);
        }
        return $response;
    }

    /* Devuelve el mensaje de guardado de cuentas.
     * */
    public function saveMessage( $saved )
    {   $message = "Error al actualizar las cuentas.";
        if($saved == 1)
            $message = "Cuentas actualizadas con exito!";
        return $message;
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