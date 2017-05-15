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
        $listOfAccounts = $this->createAccountsList(
            $this->processJson(
                $this->getFileContent($file)
                )
        );
        return $listOfAccounts;
    }

    public function createAccountsList($data){

       foreach ($data as $d) {
           $empresa = Empresa::where('nombre', $d->company)->first();
           if (!$empresa){
               $empresa = new Empresa();
               $empresa->nombre = $d->company;
               $empresa->save();
           }

           $cuenta = Cuenta::where('nombre', $d->account)->first();
           if (!$cuenta){
               $cuenta = new Cuenta();
               $cuenta->nombre = $d->account;
               $cuenta->save();
           }

           $cuenta_empresa = new Cuenta_Empresa();
           $cuenta_empresa->cuenta_id = $cuenta->id;
           $cuenta_empresa->empresa_id = $empresa->id;
           $cuenta_empresa->periodo = $d->period;
           $cuenta_empresa->monto = $d->amount;

           $cuenta_empresa->save();
       }

        $ListaDeDatos=SingletonCuentas::getInstance();
        foreach ($data as $ar) {
            $cuenta=new EmpresaCuentas();
            $cuenta->setNombreEmpresa($ar->company);
            $cuenta->setNombreCuenta($ar->account);
            $cuenta->setPeriodo($ar->period);
            $cuenta->setMonto($ar->amount);
            $ListaDeDatos->addCuentasToList($cuenta);
        }

        $ListaDeDatos->setCreated(Carbon::now()->toDateTimeString());
        return $ListaDeDatos;
    }

    public function getFileContent($file){
        return file_get_contents($file);
    }

    public function processJson($fileContent){
        return json_decode($fileContent);
    }
}