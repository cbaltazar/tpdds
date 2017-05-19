<?php

namespace App\Model;

use App\Providers\SingletonCuentas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileManager
{
    private $filePath;
    private $response = null;

    function __construct()
    {
    }

    public function getProcessedFile(){
        return $this->response;
    }

    public function processFile($file)
    {
        $this->createAccountsList(
            $this->processJson(
                $this->getFileContent($file)
                )
        );
    }

    public function createAccountsList($data){
       foreach ($data as $d) {
           $empresa = $this->getObject('App\Model\Empresa', $d->company);
           $cuenta = $this->getObject('App\Model\Cuenta', $d->account);

           $cuenta_empresa = new Cuenta_Empresa();
           $cuenta_empresa->cuenta_id = $cuenta->id;
           $cuenta_empresa->empresa_id = $empresa->id;
           $cuenta_empresa->periodo = $d->period;
           $cuenta_empresa->monto = $d->amount;

           $cuenta_empresa->save();
       }
    }

    public function getFileContent($file){
        return file_get_contents($file);
    }

    public function processJson($fileContent){
        return json_decode($fileContent);
    }

    public function getObject($type, $name){
        $object = $type::where('nombre', $name)->first();
        if (!$object){
            $object = new $type();
            $object->nombre = $name;
            $object->save();
        }
        return $object;
    }
}