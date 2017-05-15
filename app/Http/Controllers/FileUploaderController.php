<?php

namespace App\Http\Controllers;

use App\Model\FileManager;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class FileUploaderController extends Controller
{
    public function store(Request $request){
        $fileManager = new FileManager();
        $fileManager->processFile($request->file("file")->getPathName());

        return redirect('loadAccounts')->with('status', 'Archivo cargado correctamente!');
    }
}
