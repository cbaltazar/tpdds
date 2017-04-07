<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;

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
            $error = 1;
        }
        $fileToRead = fopen($file->getPathName(), "rb");

        return redirect('loadAccount?err='.$error);
        //return redirect('loadAccount');
    }

}