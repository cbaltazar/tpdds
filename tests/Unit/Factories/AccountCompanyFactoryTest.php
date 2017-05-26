<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 26/05/17
 * Time: 16:54
 */

use App\Model\Entities\Factories\AccountCompanyFactory;

class AccountCompanyFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new AccountCompanyFactory();
    }

    public function testCreateObjectCuentaEmpresa()
    {
        $this->assertEquals('App\Model\Entities\Cuenta_Empresa', get_class($this->object->createObject()));
    }
}
