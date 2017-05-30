<?php

use App\Model\Domain\DomainManagers\AccountsManager;
use PHPUnit\Framework\TestCase;

class AccountsManagerTest extends TestCase
{
    protected $accountManager = null;
    protected $cuentaEmpresaFactory = null;
    protected $cuentaEmpresa = null;
    protected $empresa = null;
    protected $cuenta = null;
    protected $orm = null;


    protected function setUp(){
        $this->orm = Mockery::mock('App\Model\ORMConnections\EloquentConnection')->makePartial();
        $this->orm->shouldReceive('saveEntity')->once()->andReturn(1);

        $this->empresa = Mockery::mock('App\Model\Entities\Empresa')->makePartial();
        $this->empresa->shouldReceive('getId')->once()->andReturn(1);

        $this->cuenta = Mockery::mock('App\Model\Entities\Cuenta')->makePartial();
        $this->cuenta->shouldReceive('getId')->once()->andReturn(2);

        $this->cuenta_empresa = Mockery::mock('App\Model\Entities\Cuenta_Empresa')->makePartial();

        $this->cuentaEmpresaFactory = Mockery::mock('App\Model\Factories\Entities\Cuenta_EmpresaFactory')->makePartial();
        $this->cuentaEmpresaFactory->shouldReceive('createObject')->once()->andReturn( $this->cuenta_empresa );

        $this->accountManager = Mockery::mock('App\Model\Domain\DomainManagers\AccountsManager')->makePartial();
        $this->accountManager->shouldReceive('getObject')->times(2)->andReturn($this->empresa, $this->cuenta);
        $this->accountManager->setOrmConnection($this->orm);
    }

    public function testGetInstance(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\AccountsManager",get_class($instance));
    }

    public function testSaveElement(){
        $data = "{\"company\":\"Facebook Inc.\",\"period\":2013,\"account\":\"EBITDA\",\"amount\":25791}";

        $this->assertEquals("App\Model\Entities\Cuenta_Empresa", get_class($this->accountManager->saveAccountCompanyElement(json_decode($data))));
    }

    public function testSaveMessageOK(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("Cuentas actualizadas con exito!", $instance->saveMessage(1));
    }

    public function testSaveMessageFAIL(){
        $instance = AccountsManager::getInstance();
        $this->assertEquals("Error al actualizar las cuentas.", $instance->saveMessage(0));
    }
}
