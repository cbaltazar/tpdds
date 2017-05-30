<?php

use App\Model\Domain\DomainManagers\AccountsManager;
use PHPUnit\Framework\TestCase;

class AccountsManagerTest extends TestCase
{
    protected function setUp(){
        
    }

    public function testGetInstance(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\AccountsManager",get_class($instance));
    }

    /*public function testSaveElement(){

    }*/

    public function testSaveMessageOK(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("Cuentas actualizadas con exito!", $instance->saveMessage(1));
    }

    public function testSaveMessageFAIL(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("Error al actualizar las cuentas.", $instance->saveMessage(0));
    }
}
