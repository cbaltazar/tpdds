<?php

use App\Model\Entities\Factories\EmpresaFactory;

class EmpresaFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new EmpresaFactory();
    }

    public function testCreateObjectEmpresa()
    {
        $this->assertEquals('App\Model\Entities\Empresa', get_class($this->object->createObject()));
    }
}
