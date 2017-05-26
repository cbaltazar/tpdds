<?php

use App\Model\Entities\Factories\IndicadorFactory;

class IndicadorFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new IndicadorFactory();
    }

    public function testCreateObjectIndicador()
    {
        $this->assertEquals('App\Model\Entities\Indicador', get_class($this->object->createObject()));
    }
}
