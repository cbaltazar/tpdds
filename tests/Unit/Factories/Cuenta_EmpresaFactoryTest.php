<?php

use App\Model\Entities\Factories\Cuenta_EmpresaFactory;

class Cuenta_EmpresaFactoryTest extends PHPUnit_Framework_TestCase
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
