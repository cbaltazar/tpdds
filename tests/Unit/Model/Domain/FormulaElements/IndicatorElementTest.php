<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\FormulaElements\IndicatorElement;

class IndicatorElementTest extends TestCase
{
    private $model;
    private $orm;
    private $accountElement;
    private $accountEntity;

    protected function setUp(){
        $this->accountEntity = $this->getMockBuilder('App\Model\Entities\Cuenta')
            ->disableOriginalConstructor()
            ->setMethods(['getId', 'getName'])
            ->getMock();
        $this->accountEntity->method('getId')->willReturn('124');
        $this->accountEntity->method('getName')->willReturn("cuenta1");

        $this->orm = $this->getMockBuilder('App\Model\ORMConnections\EloquentConnection')
            ->disableOriginalConstructor()
            ->setMethods(['findById', 'findWhere','getElementosDeFormula'])
            ->getMock();
        $this->orm->method('findById')->willReturn($this->accountEntity);

        $this->accountElement = $this->getMockBuilder('App\Model\Domain\FormulaElements\AccountElement')
                                      ->disableOriginalConstructor()
                                      ->setMethods(['getName','getValue'])
                                      ->getMock();
        $this->accountElement->setOrmConnection($this->orm);
        $this->accountElement->expects($this->any())->method('getValue')->willReturn(200);
        $this->accountElement->expects($this->any())->method('getName')->willReturn('cuenta1');



        $this->model = $this->getMockBuilder('App\Model\Entities\Indicador')
                            ->disableOriginalConstructor()
                            ->setMethods(['getFormula', 'getElementosDeFormula'])
                            ->getMock();
        $elems='[{"id":124,"class":"Cuenta"}]';
        $this->model->method('getFormula')->willReturn('cuenta1*2');
        $this->model->expects($this->any())
                    ->method('getElementosDeFormula')
                    ->willReturn($elems);
    }

    public function testEvaluateFormula(){
        $data = new stdClass();
        $data->company = 'Facebook';
        $data->period = '2017';

        $indicatorElement = $this->getMockBuilder('App\Model\Domain\FormulaElements\IndicatorElement')
                                 ->disableOriginalConstructor()
                                 ->setMethods(['getObjectFormulaElement'])
                                 ->getMock();
        $indicatorElement->method('getObjectFormulaElement')->willReturn($this->accountElement);

        $indicatorElement->setModel($this->model);
        $indicatorElement->setOrmConnection($this->orm);

        $this->assertEquals(400, $indicatorElement->evaluateFormula($data));
    }
}
