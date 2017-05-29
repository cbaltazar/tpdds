<?php

use PHPUnit\Framework\TestCase;
use App\Model\Factories\Domain\FormulaElements\IndicatorElementFactory;

class IndicatorElementFactoryTest extends TestCase
{
    private $object;
    private $model;
    private $dm;

    protected function setUp()
    {
        $this->object = new IndicatorElementFactory();
        $this->dm = Mockery::mock('App\Model\Domain\IndicatorManager');

        $this->model = Mockery::mock('App\Model\Entities\Indicador');
        $this->model->shouldReceive('getFormula')->once()->andReturn('1');
    }

    public function testCreateObjectIndicatorElement()
    {
        $this->assertEquals('App\Model\Domain\FormulaElements\IndicatorElement',
            get_class($this->object->createObject($this->model, $this->dm))
        );
    }
}