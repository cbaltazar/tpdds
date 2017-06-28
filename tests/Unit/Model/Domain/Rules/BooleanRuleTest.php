<?php

use App\Model\Domain\Rules\RuleMIN;
use App\Model\Entities\Regla;
use PHPUnit\Framework\TestCase;

class BooleanRuleTest extends TestCase
{
    public function getArrayResults(){
        return array('1'=>0,'2'=>0,'3'=>0);
    }

    public function getRuleObject(){
        return new Regla();
    }

    public function getBooleanRuleObject(){
        $rmObject = $this->getMockBuilder('App\Model\Domain\Rules\BooleanRule')
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

    /*----  1.- Creciente/Decreciente, periodo unico (2015), unitaria ----*/
    public function testCase1a(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)) );

        $rule = $this->getRuleCondition('asc');

        $arrayResult = array('1'=>0,'2'=>0,'3'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }

    public function testCase1b(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)) );

        $rule = $this->getRuleCondition('dec');

        $arrayResult = array('1'=>0,'2'=>0,'3'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    /*-------------------------------------------------------------------------------------------------------------------------------*/


    /*----  2.- Creciente, decreciente, periodos multiples (2013 - 2016), unitaria ----*/
    public function testCase2a(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2013' => 10,'2014'=> 20,'2015'=> 30,'2016' => 40),
                array('2013' => 120,'2014' => 110,'2015' => 100,'2016' => 90),
                array('2013' => 40,'2014' => 50,'2015' => 60,'2016' => 70)));

        $rule = $this->getRuleCondition('asc');
        $rule->setDesde(2013);
        $rule->setHasta(2016);

        $arrayResult = array('1'=>0, '3'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }

    public function testCase2b(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2013' => 10,'2014'=> 20,'2015'=> 30,'2016' => 40),
                array('2013' => 120,'2014' => 110,'2015' => 100,'2016' => 90),
                array('2013' => 40,'2014' => 50,'2015' => 60,'2016' => 70)));

        $rule = $this->getRuleCondition('dec');
        $rule->setDesde(2013);
        $rule->setHasta(2016);

        $arrayResult = array('2'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    /*-------------------------------------------------------------------------------------------------------------------------------*/


    /*----  3. Menor que, Mayor que, unico periodo (2016), unitaria ----*/
    public function testCase3a(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)));

        $rule = $this->getRuleCondition('minq,50');

        $arrayResult = array('1'=>0, '3'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }

    public function testCase3b(){
        $rmObject = $this->getBooleanRuleObject();
        $rmObject->expects($this->any(2))
            ->method('getValuesOfPeriods')
            ->will( $this->onConsecutiveCalls(array('2015' => 10), array('2015' => 120), array('2015'=>30)));

        $rule = $this->getRuleCondition('maxq,50');

        $arrayResult = array('2'=>0);
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    /*-------------------------------------------------------------------------------------------------------------------------------*/


    /*----  4. Menor que, Mayor que, unico periodo (2013, 2014, 2015, 2016), sumatoria ----*/
    public function getElementCase4(){
        $element = $this->getMockBuilder('App\Model\Domain\FormulaElements\IndicatorElement')
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])->getMock();
        $element->method('getValue')
            ->will( $this->onConsecutiveCalls(5,6,7,5,10,100,11,12,13,10,10,2) );

        return $element;
    }

    public function getBooleanRuleObjectCase4(){
        $rmObject = $this->getMockBuilder('App\Model\Domain\Rules\BooleanRule')
            ->disableOriginalConstructor()
            ->setMethods(['getElement'])->getMock();

        $rmObject->method('getElement')->willReturn( $this->getElementCase4() );

        return $rmObject;
    }

    public function getRuleConditionCase4($cond){
        $ruleMinor = $this->getRuleObject();
        $ruleMinor->setElemento('40,Cuenta,FCF');
        $ruleMinor->setCondicion($cond);
        $ruleMinor->setDesde(2013);
        $ruleMinor->setHasta(2016);
        $ruleMinor->setModalidad('sum');

        return $ruleMinor;
    }

    //sumatoria menor que
    public function testCase4a(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('1'=>0, '3'=>0);
        $rule = $this->getRuleConditionCase4('minq,50');
        $rule->setModalidad('sum');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }

    //sumatoria mayor que
    public function testCase4a1(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('2'=>0);
        $rule = $this->getRuleConditionCase4('maxq,50');
        $rule->setModalidad('sum');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }

    //promedio menor que
    public function testCase4b(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('1'=>0, '3'=>0);
        $rule = $this->getRuleConditionCase4('minq,10');
        $rule->setModalidad('avg');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    //promedio mayor que
    public function testCase4b1(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('2'=>0);
        $rule = $this->getRuleConditionCase4('maxq,20');
        $rule->setModalidad('avg');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    //media menor que
    public function testCase4c(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('1'=>0, '3'=>0);
        $rule = $this->getRuleConditionCase4('minq,10');
        $rule->setModalidad('med');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    //media mayor que
    public function testCase4c1(){
        $rmObject = $this->getBooleanRuleObjectCase4();
        $arrayResult = array('2'=>0, '3'=>0);
        $rule = $this->getRuleConditionCase4('maxq,10');
        $rule->setModalidad('med');
        $this->assertEquals($arrayResult, $rmObject->evaluate( $this->getArrayResults(), $rule));
    }
    /*-------------------------------------------------------------------------------------------------------------------------------*/

}
