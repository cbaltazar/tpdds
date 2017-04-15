<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Providers\SingletonCuentas;
use App\EmpresaCuentasAux;

class FileuploadingController extends Controller
{
    public function store(Request $request){
        $file = $request->file("file");
        $dest = "./AccountFiles/".$file->getClientOriginalName();
        $message = "Archivo cargado correctamente!!!";
        $error = 0;
        if ( ! File::copy($file, $dest))
        {
            $message = "Error al cargar el archivo!";
            $error=1;
            return redirect('loadAccount?err='.$error);
        }
        else {
          $this->processFileJSon($file);
        }
    }

    private function processFileJSon($file)
    {
        $linea=file_get_contents($file->getPathName());
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

          //Lee el singleton, este código hay que adaptarlo a donde se muestren los datos
         $ListaDeDatos=SingletonCuentas::getInstance();
          foreach ($ListaDeDatos->getListCuentas() as $cuenta) {
             echo "[",$cuenta -> getNombreEmpresa(),$cuenta -> getNombreCuenta(),$cuenta -> getPeriodo(),$cuenta -> getMonto(),"]", "\r\n";
           }

    }


}
