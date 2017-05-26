<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 26/05/17
 * Time: 16:49
 */

use App\Model\Entities\Factories\AccountFactory;

class AccountFactoryTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new AccountFactory();
    }

    public function testCreateObjectCuenta()
    {
        $this->assertEquals('App\Model\Entities\Cuenta', get_class($this->object->createObject()));
    }
}
