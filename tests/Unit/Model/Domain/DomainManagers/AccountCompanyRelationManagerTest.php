<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;

class AccountCompanyRelationManagerTest extends TestCase
{
    public function testGetInstance(){
        $instance = AccountCompanyRelationManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\AccountCompanyRelationManager", get_class($instance));
    }
}
