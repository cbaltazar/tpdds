<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Model\FileManager;
use Illuminate\Support\Facades\Session;

class MainTest extends TestCase
{
    public function testLoadFile()
    {
        $fileManager = new FileManager();
        $accounts = $fileManager->processFile( __DIR__.DIRECTORY_SEPARATOR."testing.json")->getListCuentas();

        $this->assertEquals("Facebook Inc.", $accounts[0]->getNombreEmpresa());
        $this->assertEquals("FCF(B)", $accounts[0]->getNombreCuenta());
        $this->assertEquals(2016, $accounts[0]->getPeriodo());
        $this->assertEquals(28.28, $accounts[0]->getMonto());

        $this->assertEquals("Facebook Inc.", $accounts[1]->getNombreEmpresa());
        $this->assertEquals("Discontinued Operations(B)", $accounts[1]->getNombreCuenta());
        $this->assertEquals(2016, $accounts[1]->getPeriodo());
        $this->assertEquals(0, $accounts[1]->getMonto());

        $this->assertEquals("Facebook Inc.", $accounts[2]->getNombreEmpresa());
        $this->assertEquals("Continuing Operations (B)", $accounts[2]->getNombreCuenta());
        $this->assertEquals(2016, $accounts[2]->getPeriodo());
        $this->assertEquals(53.21, $accounts[2]->getMonto());
//-------------------------------------------------------------------------------------------------
        $this->assertEquals("Apple Inc.", $accounts[3]->getNombreEmpresa());
        $this->assertEquals("EBITDA", $accounts[3]->getNombreCuenta());
        $this->assertEquals(2013, $accounts[3]->getPeriodo());
        $this->assertEquals(33627, $accounts[3]->getMonto());

        $this->assertEquals("Apple Inc.", $accounts[4]->getNombreEmpresa());
        $this->assertEquals("FDS(M)", $accounts[4]->getNombreCuenta());
        $this->assertEquals(2013, $accounts[4]->getPeriodo());
        $this->assertEquals(7627, $accounts[4]->getMonto());

        $this->assertEquals("Apple Inc.", $accounts[5]->getNombreEmpresa());
        $this->assertEquals("FCF(B)", $accounts[5]->getNombreCuenta());
        $this->assertEquals(2013, $accounts[5]->getPeriodo());
        $this->assertEquals(29.23, $accounts[5]->getMonto());
    }
}
