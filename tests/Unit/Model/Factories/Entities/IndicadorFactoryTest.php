<?php

use App\Model\Factories\Entities\IndicadorFactory;
use PHPUnit\Framework\TestCase;

class IndicadorFactoryTest extends TestCase
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
