<?php

use PHPUnit\Framework\TestCase;
use App\Model\Factories\Entities\EmpresaFactory;

class EmpresaFactoryTest extends TestCase
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
