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
        $linea=file_get_contents($file);
        //     var_dump (json_decode ($linea));
        $array = json_decode($linea, true);

        $ListaDeDatos=SingletonCuentas::getInstance();
        foreach ($array as $ar) {
            //        echo $ar["company"],$ar["period"],$ar["account"],$ar["amount"], "\n";
            $cuenta=new EmpresaCuentasAux();
            $cuenta->setNombreEmpresa($ar["company"]);
            $cuenta->setNombreCuenta($ar["account"]);
            $cuenta->setPeriodo($ar["period"]);
            $cuenta->setMonto($ar["amount"]);
            $ListaDeDatos->addCuentasToList($cuenta);
        }

        Session::put("ListaDeDatos", $ListaDeDatos);
    }
}