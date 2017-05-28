<?php

namespace App\Model\Utilities;

class FileManager
{
    private $filePath = null;
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
        $this->createAccountsList(
            $this->processJson(
                $this->getFileContent($file)
                )
        );
    }

    public function createAccountsList($data){
        $this->domainManager->save($data, null);
    }

    public function getFileContent($file){
        return file_get_contents($file);
    }

    public function processJson($fileContent){
        return json_decode($fileContent);
    }
}