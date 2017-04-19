<?php

namespace App\Model;

use App\Providers\SingletonCuentas;
use Illuminate\Http\Request;

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
        $ListaDeDatos=SingletonCuentas::getInstance();
        foreach ($data as $ar) {
            $cuenta=new EmpresaCuentasAux();
            $cuenta->setNombreEmpresa($ar->company);
            $cuenta->setNombreCuenta($ar->account);
            $cuenta->setPeriodo($ar->period);
            $cuenta->setMonto($ar->amount);
            $ListaDeDatos->addCuentasToList($cuenta);
        }
        return $ListaDeDatos;
    }

    //testGetFilecontent
    public function getFileContent($file){
        return file_get_contents($file);
    }

    //testProcessJson
    public function processJson($fileContent){
        return json_decode($fileContent);
    }
}