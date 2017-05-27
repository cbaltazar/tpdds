<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\FormulaElements\AccountElement;

class AccountElementTest extends TestCase
{
    private $dmMock;
    private $accountMock;

    protected function setUp()
    {
        $this->accountMock = Mockery::mock('App\Domain\DomainManagers\AccountCompanyRelationManager');
        $this->accountMock->shouldReceive('monto')->once()->andReturn(123);

        $this->dmMock = Mockery::mock('App\Domain\DomainManagers\AccountCompanyRelationManager');
        $this->dmMock->shouldReceive('getWhere')->once()->andReturn($this->accountMock);
    }

    public function testGetValue(){
        $accountElement = new AccountElement($this->accountMock, $this->dmMock);
    }
}
