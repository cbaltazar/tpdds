<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\FormulaElements\AccountElement;

class AccountElementTest extends TestCase
{
    private $model;
    private $accountCompanyMock;
    private $orm;

    protected function setUp()
    {
        $this->accountCompanyMock = Mockery::mock('App\Model\Entities\Cuenta_Empresa');
        $this->accountCompanyMock->shouldReceive('getMonto')->once()->andReturn(123);

        $this->orm = $this->getMockBuilder('App\Model\ORMConnections\EloquentConnection')
                          ->disableOriginalConstructor()
                          ->setMethods(['findWhere'])
                          ->getMock();
        $this->orm->method('findWhere')->willReturn($this->accountCompanyMock);

        $this->model = Mockery::mock('App\Model\Entities\Cuenta');
        $this->model->shouldReceive('getId')->once()->andReturn(1);
        $this->model->shouldReceive('getFormula')->once()->andReturn("");
    }

    public function testGetValue(){
        $data = new stdClass();
        $data->company = 'Facebook';
        $data->period = '2017';

        $accountElement = new AccountElement();
        $accountElement->setOrmConnection($this->orm);
        $accountElement->setModel($this->model);
        $this->assertEquals(123, $accountElement->getValue($data));
        $accountElement->getValue($data);
    }
}
