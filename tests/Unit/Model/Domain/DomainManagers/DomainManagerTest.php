<?php

use PHPUnit\Framework\TestCase;
use App\Model\Domain\DomainManagers\DomainManager;
use App\Model\Entities\Cuenta;

class DomainManagerTest extends TestCase
{
    protected $ormConnection = null;
    protected $domainManager = null;
    protected $formulaElement = null;
    protected $entity = null;

    protected function setUp(){
        $this->entity = new Cuenta();

        $this->formulaElement = $this->createMock('App\Model\Domain\FormulaElements\AccountElement');

        $this->ormConnection = $this->createMock('App\Model\ORMConnections\EloquentConnection');
        $this->ormConnection->method('findFormulaElementEntity')->willReturn($this->entity);

        $this->domainManager = $this->getMockForAbstractClass(DomainManager::class);
        $this->domainManager->setOrmConnection($this->ormConnection);
    }

    public function testGetOrmConnection(){
        $orm = $this->domainManager->getOrmConnection();
        $ormName = explode("_", get_class($orm))[1];
        $this->assertEquals("EloquentConnection", $ormName);
    }

    public function testGetFromulaElement(){
        $entityElement = get_class($this->domainManager->getFromulaElement(null));
        $this->assertEquals('App\Model\Entities\Cuenta',$entityElement);
    }

    public function testGetObjectFormulaElement(){
        $accountElement = get_class($this->domainManager->getObjectFormulaElement( $this->entity ));
        $this->assertEquals('App\Model\Domain\FormulaElements\AccountElement', $accountElement);
    }

/*

        public function getObjectFormulaElement( $entity )
        {
            switch ( get_class($entity) ){
                case 'App\Model\Entities\Cuenta':
                    return new AccountElement($entity, AccountCompanyRelationManager::getInstance());
                    break;
                default:
                    return new IndicatorElement($entity, IndicatorsManager::getInstance());
            }
        }

        public function getFactory($type){
            $namespace = explode("\\", $type, 3);
            $namespace[count($namespace)-1] = 'Factories\\'.$namespace[count($namespace)-1]."Factory";
            $factory = implode('\\', $namespace);

            return new $factory();
        }*/

}
