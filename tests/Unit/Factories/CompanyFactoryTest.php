<?php

use App\Model\Entities\Factories\CompanyFactory;

class CompanyFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new CompanyFactory();
    }

    public function testCreateObjectEmpresa()
    {
        $this->assertEquals('App\Model\Entities\Empresa', get_class($this->object->createObject()));
    }
}
