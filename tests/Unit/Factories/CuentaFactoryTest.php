<?php

use PHPUnit\Framework\TestCase;
use App\Model\Entities\Factories\CuentaFactory;

class CuentaFactoryTest extends TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new CuentaFactory();
    }

    public function testCreateObjectCuenta()
    {
        $this->assertEquals('App\Model\Entities\Cuenta', get_class($this->object->createObject()));
    }
}
