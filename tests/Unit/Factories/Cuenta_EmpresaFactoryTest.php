<?php

use PHPUnit\Framework\TestCase;
use App\Model\Entities\Factories\Cuenta_EmpresaFactory;

class Cuenta_EmpresaFactoryTest extends TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new Cuenta_EmpresaFactory();
    }

    public function testCreateObjectCuentaEmpresa()
    {
        $this->assertEquals('App\Model\Entities\Cuenta_Empresa', get_class($this->object->createObject()));
    }
}
