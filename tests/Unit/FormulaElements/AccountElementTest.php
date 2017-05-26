<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 26/05/17
 * Time: 17:45
 */

use App\Model\Domain\FormulaElements\AccountElement;

class AccountElementTest extends PHPUnit_Framework_TestCase
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

    }
}
