<?php

use App\Model\Domain\Rules\OrderRule;
use PHPUnit\Framework\TestCase;
use App\Model\Entities\Regla;

class OrderRuleTest extends TestCase
{

    public function getArrayResults(){
        return array('1'=>0,'2'=>0,'3'=>0);
    }

    public function getRuleObject(){
        return new Regla();
    }

    public function getBooleanRuleObject(){
        $rmObject = $this->getMockBuilder('App\Model\Domain\Rules\OrderRule')
            ->disableOriginalConstructor()
            ->setMethods(['getValuesOfPeriods', 'getElement'])->getMock();
        return $rmObject;
    }

    public function getRuleCondition($cond){
        $ruleMinor = $this->getRuleObject();
        $ruleMinor->setElemento('40,Cuenta,FCF');
        $ruleMinor->setCondicion($cond);
        $ruleMinor->setDesde(2015);
        $ruleMinor->setHasta(2015);
        $ruleMinor->setModalidad('uni');
        return $ruleMinor;
    }

    //menor, periodo unico, unitario
    public function testCase1(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)) );

        $rule = $this->getRuleCondition('min');

        $arrayResult = array('1'=>3,'2'=>1,'3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));

    }

    //menor, periodo multiple (2013-2016), unitario
    public function testCase2(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2013' => 10,'2014'=> 20,'2015'=> 30,'2016' => 40),
                                                array('2013' => 120,'2014' => 110,'2015' => 100,'2016' => 90),
                                                array('2013' => 40,'2014' => 50,'2015' => 60,'2016' => 70)));

        $rule = $this->getRuleCondition('min');

        $arrayResult = array('1'=>3,'2'=>1,'3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));

    }

    //mayor, periodo unico, unitario
    public function testCase3(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)) );

        $rule = $this->getRuleCondition('min');

        $arrayResult = array('1'=>3,'2'=>1,'3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));

    }

    //mayor, periodo multiple (2013-2016), unitario
    public function testCase4(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2013' => 10,'2014'=> 20,'2015'=> 30,'2016' => 40),
                array('2013' => 120,'2014' => 110,'2015' => 100,'2016' => 90),
                array('2013' => 40,'2014' => 50,'2015' => 60,'2016' => 70)));

        $rule = $this->getRuleCondition('min');

        $arrayResult = array('1'=>3,'2'=>1,'3'=>2);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));

    }
}
