<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use \Illuminate\Http\Request;

class IndicatorsManagerTest extends TestCase
{
    protected $indicatorManager = null;
    protected $params1, $params2;
    protected $validator;

    protected function setUp(){
        $this->validator = Mockery::mock('App\Model\Utilities\Validators\ValidateIndicatorInput')->makePartial();
        $this->validator->shouldReceive('validateParams')->once()->andReturn(1);

        $this->params1 = new \stdClass();
        $this->params1->name = 'Indicador1';
        $this->params1->description = 'descripcion';
        $this->params1->formula = 'formula';
        $this->params1->elementosDeFormula = "elementos";
        $this->params1->activo = 1;

        $this->params2 = new \stdClass();
        $this->params2->name = 'Indicador2';
        $this->params2->description = 'descripcion2';
        $this->params2->formula = 'formula2';
        $this->params2->elementosDeFormula = "elementos2";
        $this->params2->activo = 0;

        $indicatorEntity = Mockery::mock('App\Model\Entities\Indicador')->makePartial();

        $factory = Mockery::mock('App\Model\Factories\Entities\IndicadorFactoy')->makePartial();
        $factory->shouldReceive('createObject')->times(2)->andReturn($indicatorEntity);

        $this->orm = Mockery::mock('App\Model\ORMConnections\EloquentConnection')->makePartial();
        $this->orm->shouldReceive('findById')->times(2)->andReturn($indicatorEntity);
        $this->orm->shouldReceive('saveEntity')->times(2)->andReturn(1,1);

        $this->indicatorManager = Mockery::mock('App\Model\Domain\DomainManagers\IndicatorsManager')->makePartial();
        $this->indicatorManager->setOrmConnection($this->orm);
        $this->indicatorManager->shouldReceive('getOne')->once()->andReturn($indicatorEntity);
        $this->indicatorManager->shouldReceive('getFactory')->once()->andReturn($factory);
        $this->indicatorManager->shouldReceive('validateParams')->once()->andReturn(1);
        $this->indicatorManager->setValidator($this->validator);
    }

    public function testGetInstance(){
        $instance = IndicatorsManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\IndicatorsManager",get_class($instance));
    }

    public function testSaveNEWElement(){
        $this->indicatorManager->shouldReceive('getParams')->once()->andReturn($this->params1);
        $indicatorSaved = $this->indicatorManager->saveElement(null, 1);
        $this->assertEquals("Indicador1", $indicatorSaved->getNombre());
        $this->assertEquals("descripcion", $indicatorSaved->getDescripcion());
        $this->assertEquals("formula", $indicatorSaved->getFormula());
        $this->assertEquals("elementos", $indicatorSaved->getElementosDeFormula());
        $this->assertEquals(1, $indicatorSaved->isActive());
    }

    public function testSaveUPDATEElement(){
        $this->indicatorManager->shouldReceive('getParams')->once()->andReturn($this->params2);
        $indicatorSaved = $this->indicatorManager->saveElement(null, null);
        $this->assertEquals("Indicador2", $indicatorSaved->getNombre());
        $this->assertEquals("descripcion2", $indicatorSaved->getDescripcion());
        $this->assertEquals("formula2", $indicatorSaved->getFormula());
        $this->assertEquals("elementos2", $indicatorSaved->getElementosDeFormula());
        $this->assertEquals(0, $indicatorSaved->isActive());
    }

    public function testSaveOKMessage(){
        $indicatorManager = IndicatorsManager::getInstance();
        $this->assertEquals("Indicador guardado con exito!", $indicatorManager->saveMessage(1));
    }

    public function testSaveFAILMessage(){
        $indicatorManager = IndicatorsManager::getInstance();
        $this->assertEquals("Error al guardar el indicador.", $indicatorManager->saveMessage(0));
    }

    /*public function testIndicatorEvaluate(){
        se agrega luego del refactor.
    }*/

}
