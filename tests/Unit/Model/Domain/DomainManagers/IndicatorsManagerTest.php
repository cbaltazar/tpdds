<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use \Illuminate\Http\Request;

class IndicatorsManagerTest extends TestCase
{
    protected $indicatorManager = null;
    protected $request = null;

    protected function setUp(){
        $this->request = Mockery::mock('\Illuminate\Http\Request')->makePartial();
        $this->request->shouldReceive('input')->times(3)->andReturn('Indic1', 'Descripcion', 'Cuenta1+555');

        $indicatorEntity = Mockery::mock('App\Model\Entities\Indicador')->makePartial();

        $factory = Mockery::mock('App\Model\Factories\Entities\IndicadorFactoy')->makePartial();
        $factory->shouldReceive('createObject')->once()->andReturn($indicatorEntity);

        $this->orm = Mockery::mock('App\Model\ORMConnections\EloquentConnection')->makePartial();
        $this->orm->shouldReceive('findById')->once()->andReturn($indicatorEntity);

        $this->indicatorManager = Mockery::mock('App\Model\Domain\DomainManagers\IndicatorsManager')->makePartial();
        $this->indicatorManager->setOrmConnection($this->orm);
    }

    public function testGetInstance(){
        $instance = IndicatorsManager::getInstance();
        $this->assertEquals("App\Model\Domain\DomainManagers\IndicatorsManager",get_class($instance));
    }

    public function testSaveElement(){
        var_dump($this->indicatorManager->saveElement($this->request, 1));
    }
    /*

    public function saveElement($data, $id){
        $indicator = null;
        if( $id != null){
            $indicator = $this->getOne($id);
        }else{
            $indicatorFactory = $this->getFactory(Indicador::class);
            $indicator = $indicatorFactory->createObject();
        }

        $indicator->nombre = $data->input('name');
        $indicator->descripcion = $data->input('description');
        is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
        $indicator->formula = $data->input('formula');
        $indicator->elementosDeFormula = $data->formulaElements;

        $this->ormConnection->saveEntity($indicator);
    }

    public function saveMessage($saved)
    {
        return "Indicador guardado con exito!";
    }

    function deleteRelations($id){}

    public function deleteMessage(){}

    public function indicatorEvaluate($request){
        $indicators = $this->getAll();
        $results = array();

        foreach ($indicators as $indicator){
            if($indicator->isActive()){
                array_push($results, $this->prepareIndicator($indicator, $request));
            }
        }

        return json_encode($results);
    }

    public function prepareIndicator($indicator, $request){
        $result = new \stdClass();
        $formulaElementFactory = $this->getFactory(IndicatorElement::class);
        $indicatorElement = $formulaElementFactory->createObject($indicator, IndicatorsManager::getInstance());
        $empresa = $this->ormConnection->findById(Empresa::class, $request->input('company'));
        $result->company = $empresa->getNombre();
        $result->indicator = $indicator->getNombre();
        $result->period = $request->input('period');
        if($indicator->isActive() == 1){
            $result->value = $indicatorElement->evaluateFormula($request->input());
        }else{
            $result->value = "Inactivo";
        }

        return $result;
    }
    */
}
