<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\MethodologiesManager;
use \App\Model\Entities\Regla;

class MethodologiesManagerTest extends TestCase
{
    public function getRuleObject(){
        return new Regla();
    }

    public function getRuleMinor(){
        $ruleMinor = $this->getRuleObject();
        $ruleMinor->setElemento('40,Cuenta,FCF');
        $ruleMinor->setCondicion('min');
        $ruleMinor->setDesde(2013);
        $ruleMinor->setHasta(2016);
        $ruleMinor->setModalidad('uni');

        return $ruleMinor;
    }

    public function getRuleList(){
        $ruleList = array();
        array_push($ruleList, $this->getRuleMinor());

        return $ruleList;
    }

    public function getMethodologyObject(){
        /*Necesito:
         - un array de resultados.
         - objeto Metodologia
         - con objetos regla dentro
         - objetos Regla que calculan
         - mockear getValuesOfPeriods
         * */
        $methodologyObject = $this->getMockBuilder('App\Model\Domain\Entities\Metodologia')
                                  ->disableOriginalConstructor()
                                  ->setMethods(['reglas'])->getMock();

        $methodologyObject->method('reglas')->willReturn($this->getRuleList());

        return $methodologyObject;
    }

    public function prepareMethodologyManager(){
        $methodologyManagerObject = $this->getMockBuilder('App\Model\Domain\DomainManagers\MethodologiesManager')
            ->disableOriginalConstructor()
            ->setMethods(['prepareArrayResults', 'getOne'])->getMock();

        $methodologyManagerObject->method('prepareArrayResults')->willReturn( array('1'=>0,'2'=>0,'3'=>0));
        $methodologyManagerObject->method('getOne')->willReturn( $this->getMethodologyObject() );

        return $methodologyManagerObject;
    }

    public function testGetRuleList(){
        $methodologyObject = $this->getMethodologyObject();
        var_dump($methodologyObject->prepareArrayResults());
    }
}
