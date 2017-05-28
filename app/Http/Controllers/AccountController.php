<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Utilities\FileManager;
use Illuminate\Http\Request;
use App\Http\Requests;

class AccountController extends Controller
{
    /*
     * Se encarga de cargar el archivo de cuentas. Utiliza el FileManager, que lee los datos
     * y procesa la informacion. Al FileManager, se le pasa el manager del elemento de dominio
     * correspondiente, en este caso Accounts (Cuentas).
     *
     * */
    public function store(Request $request){
        $fileManager = new FileManager(AccountsManager::getInstance());
        $fileManager->processFile($request->file("file")->getPathName());

        return redirect('companyList')->with('status', 'Archivo cargado correctamente!');
    }
}
