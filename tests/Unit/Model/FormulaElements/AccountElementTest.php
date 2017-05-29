<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\FormulaElements\AccountElement;

class AccountElementTest extends TestCase
{
    private $domainManager;
    private $model;
    private $accountCompanyMock;

    protected function setUp()
    {
        $this->accountCompanyMock = Mockery::mock('App\Model\Entities\Cuenta_Empresa');
        $this->accountCompanyMock->shouldReceive('getMonto')->once()->andReturn(123);

        $this->model = Mockery::mock('App\Model\Entities\Cuenta');
        $this->model->shouldReceive('getId')->once()->andReturn(1);

        $this->domainManager = Mockery::mock('App\Domain\DomainManagers\AccountManager');
        $this->domainManager->shouldReceive('getWhere')->once()->andReturn($this->accountCompanyMock);
    }

    public function testGetValue(){
        $data = array();
        $data['company'] = 'Facebook';
        $data['period'] = '2017';

        $accountElement = new AccountElement($this->model, $this->domainManager);
        $this->assertEquals(123, $accountElement->getValue($data));
        $accountElement->getValue($data);
    }
}
