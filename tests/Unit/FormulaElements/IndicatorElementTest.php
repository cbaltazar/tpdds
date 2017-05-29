<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\FormulaElements\IndicatorElement;

class IndicatorElementTest extends TestCase
{
    private $domainManager;
    private $model;
    private $objectModel;
    private $objectAccountElement;

    protected function setUp(){
        $this->objectModel = Mockery::mock('App\Model\Entities\Cuenta');
        $this->objectModel->shouldReceive('getFormula')->once()->andReturn('cuenta1*2');

        $this->objectAccountElement = Mockery::mock('App\Model\Domain\FormulaElements\AccountElement');
        $this->objectAccountElement->shouldReceive('getValue')->once()->andReturn("555");
        $this->objectAccountElement->shouldReceive('getName')->once()->andReturn("cuenta1");

        $this->model = Mockery::mock('App\Model\Entities\Indicador');
        $this->model->shouldReceive('getElementosDeFormula')->once()->andReturn("1");
        $this->model->shouldReceive('getFormula')->once()->andReturn("cuenta1*2");

        $this->domainManager = Mockery::mock('App\Domain\DomainManagers\IndicatorManager');
        $this->domainManager->shouldReceive('getFromulaElement')->once()->andReturn($this->objectModel);
        $this->domainManager->shouldReceive('getObjectFormulaElement')->once()->andReturn($this->objectAccountElement);
       }

    public function testEvaluateFormula(){
        $data = array();
        $data['company'] = 'Facebook';
        $data['period'] = '2017';

        $indicatorElement = new IndicatorElement($this->model, $this->domainManager);
        $this->assertEquals(1110, $indicatorElement->evaluateFormula($data));
    }
}
