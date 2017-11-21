<?php

namespace App\Model\Utilities;

use App\Exceptions\CustomExceptions\DataFileException;

class FileManager
{
    private $response = null;
    private $domainManager = null;

    function __construct($manager)
    {
        $this->domainManager = $manager;
    }

    public function getDomain(){
        return $this->domainManager;
    }

    public function getProcessedFile(){
        return $this->response;
    }

    public function processFile($file)
    {
        var_dump($file);
        try{
            $this->createAccountsList(
                $this->processJson(
                    $this->getFileContent($file)
                )
            );
        }catch(DataFileException $e){
            echo $e->getMessage();
            die;
        }

    }

    public function createAccountsList($data){
        if( $data )
            $this->domainManager->save($data, null);
        else
            throw new DataFileException("Error en el archivo de cuentas.");
    }

    public function getFileContent($file){
        return file_get_contents($file);
    }

    public function processJson($fileContent){
        return json_decode($fileContent);
    }
}