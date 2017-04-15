<?php

namespace App\Model;
use Illuminate\Support\Facades\File;

class FileLoader
{
    private $file;
    private $error = 0;

    function __construct()
    {
    }

    public function load($request){
        $this->file = $request->file("file");
        $dest = "./AccountFiles/".$this->file->getClientOriginalName();
        if( !File::copy($this->file, $dest) ){
            $this->error = 1;
        }else{
            $this->file = $dest;
        }
    }

    public function getFile(){
        return $this->file;
    }

    public function hasError(){
        return $this->error;
    }
}