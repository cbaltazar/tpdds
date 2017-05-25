<?php

namespace App\Model\Utilities;

use App\Model\Domain\DomainManagers\AccountsManager;

class FileManager
{
    private $filePath = null;
    private $response = null;
    private $domain = null;

    function __construct()
    {
        $this->domain = AccountsManager::getInstance();
    }

    public function getDomain(){
        return $this->domain;
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
        $this->domain->save($data, null);
    }

    public function getFileContent($file){
        return file_get_contents($file);
    }

    public function processJson($fileContent){
        return json_decode($fileContent);
    }
}