<?php

use App\Model\Domain\Rules\RuleMIN;
use App\Model\Entities\Regla;
use PHPUnit\Framework\TestCase;

class OrderRuleTest extends TestCase
{
    public function getArrayResults(){
        return array('1'=>0,'2'=>0,'3'=>0);
    }

    public function getOrderRuleObject(){
        $rmObject = $this->getMockBuilder('App\Model\Domain\Rules\OrderRule')
                         ->disableOriginalConstructor()
                         ->setMethods(['getValuesOfPeriods'])->getMock();

        $rmObject->expects($this->any(2))
                 ->method('getValuesOfPeriods')
                 ->will( $this->onConsecutiveCalls(array('2013' => 10,'2014'=> 20,'2015'=> 30,'2016' => 40),
                                                   array('2013' => 120,'2014' => 110,'2015' => 130,'2016' => 140),
                                                   array('2013' => 40,'2014' => 50,'2015' => 60,'2016' => 70)));

        return $rmObject;
    }

    public function getRuleObject(){
        return new Regla();
    }

    public function getRuleCondition($cond){
        $ruleMinor = $this->getRuleObject();
        $ruleMinor->setElemento('40,Cuenta,FCF');
        $ruleMinor->setCondicion($cond);
        $ruleMinor->setDesde(2013);
        $ruleMinor->setHasta(2016);
        $ruleMinor->setModalidad('uni');

        return $ruleMinor;
    }

    public function testOrderRuleMin(){
        $rmObject = $this->getOrderRuleObject();
        $arrayResult = array('1'=>3, '2'=>1, '3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $this->getRuleCondition('min')));
    }

    public function testOrderRuleMax(){
        $rmObject = $this->getOrderRuleObject();
        $arrayResult = array('1'=>1, '2'=>3, '3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $this->getRuleCondition('max')));
    }
}
