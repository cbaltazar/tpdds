<?php

use PHPUnit\Framework\TestCase;
use App\Model\Factories\Domain\FormulaElements\AccountElementFactory;

class AccountElementFactoryTest extends TestCase
{
    private $object;
    private $model;
    private $dm;

    protected function setUp()
    {
        $this->object = new AccountElementFactory();
        $this->dm = Mockery::mock('App\Model\Domain\AccountManager');
        $this->model = Mockery::mock('App\Model\Domain\AccountManager');
    }

    public function testCreateObjectAccountElement()
    {
        $this->assertEquals('App\Model\Domain\FormulaElements\AccountElement',
                            get_class($this->object->createObject($this->model, $this->dm))
        );
    }
}
