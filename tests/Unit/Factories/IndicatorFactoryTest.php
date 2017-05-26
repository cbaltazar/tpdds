<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 26/05/17
 * Time: 16:54
 */

use App\Model\Entities\Factories\IndicatorFactory;

class IndicatorFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new IndicatorFactory();
    }

    public function testCreateObjectIndicador()
    {
        $this->assertEquals('App\Model\Entities\Indicador', get_class($this->object->createObject()));
    }
}
