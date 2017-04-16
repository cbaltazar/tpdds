<?php

namespace App\Model;

use App\Providers\SingletonCuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function processFile(Request $request, $file)
    {
        $listOfAccounts = $this->createAccountsList(
            $this->processJson(
                $this->getFileContent($file)
                )
        );
        Session::put("ListaDeDatos", $listOfAccounts);
    }

    private function createAccountsList($data){
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

    private function getFileContent($file){
        return file_get_contents($file);
    }

    private function processJson($fileContent){
        return json_decode($fileContent);
    }
}