<?php

namespace App\Http\Controllers;

use App\Model\FileLoader;
use App\Model\FileManager;
use Illuminate\Http\Request;
use App\Http\Requests;

class FileUploaderController extends Controller
{
    public function store(Request $request){
        $fileLoader = new FileLoader();
        $fileLoader->load($request);

        $fileManager = new FileManager();
        $fileManager->processFile($fileLoader->getFile());

        return redirect('loadAccounts?err='.$fileLoader->hasError());
    }
}
