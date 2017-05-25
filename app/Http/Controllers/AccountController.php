<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Utilities\FileManager;
use Illuminate\Http\Request;
use App\Http\Requests;

class AccountController extends Controller
{
    public function store(Request $request){
        $fileManager = new FileManager();
        $fileManager->processFile($request->file("file")->getPathName());

        return redirect('loadAccounts')->with('status', 'Archivo cargado correctamente!');
    }
}
