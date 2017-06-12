<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\DomainManager;
use App\Model\Entities\Cuenta;

class DomainManagerTest extends TestCase
{
    protected $ormConnection = null;
    protected $domainManager = null;
    protected $formulaElement = null;
    protected $entity = null;

    protected function setUp(){
        $this->entity = new Cuenta();

        $this->formulaElement = $this->getMockBuilder('App\Model\Domain\FormulaElements\AccountElement');

        $this->ormConnection = $this->getMockBuilder('App\Model\ORMConnections\EloquentConnection')
                                    ->setMethods(['findFormulaElementEntity'])->getMock();
        $this->ormConnection->method('findFormulaElementEntity')->willReturn($this->entity);

        $this->domainManager = $this->getMockForAbstractClass(DomainManager::class);
        $this->domainManager->setOrmConnection($this->ormConnection);
    }

    public function testGetOrmConnection(){
        $orm = $this->domainManager->getOrmConnection();
        $ormName = explode("_", get_class($orm))[1];
        $this->assertEquals("EloquentConnection", $ormName);
    }

    public function testGetFactory(){
        $this->assertEquals('App\Model\Factories\Entities\EmpresaFactory', get_class($this->domainManager->getFactory( 'App\Model\Entities\Empresa' )));
    }

}
