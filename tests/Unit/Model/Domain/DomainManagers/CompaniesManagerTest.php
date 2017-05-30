<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\CompaniesManager;

class CompaniesManagerTest extends TestCase
{
    protected $companiesManager = null;
    protected $orm = null;

    protected function setUp(){
        $relation = Mockery::mock('App\Model\Entities\Cuenta_Empresa')->makePartial();
        $relation->shouldReceive('getId')->times(3)->andReturn(1,1,1);

        $this->orm = Mockery::mock('App\Model\ORMConnections\EloquentConnection')->makePartial();
        $this->orm->shouldReceive('findAllByColumnName')->once()->andReturn([$relation,$relation,$relation]);
        $this->orm->shouldReceive('deleteEntity')->times(3)->andReturn(1,2,3);


        $this->companiesManager = Mockery::mock('App\Model\Domain\DomainManagers\CompaniesManager')->makePartial();
    }

    public function testGetInstance(){
        $instance = CompaniesManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\CompaniesManager",get_class($instance));
    }

    public function testDeleteRelations(){
        $this->companiesManager->setOrmConnection($this->orm);
        $this->assertEquals(1, $this->companiesManager->deleteRelations(null));
    }

    public function testDeleteMessage(){
        $instance = CompaniesManager::getInstance();
        $this->assertEquals("Empresa borrada con exito!", $instance->deleteMessage());
    }
}
