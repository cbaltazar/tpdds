<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Model\FileManager;

class FileManagerTest extends TestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = new FileManager();
    }

    private function getObject(){
        return $this->object;
    }

    /**
     * @dataProvider fileProvider
     */
    public function testGetFileContent($file, $expected)
    {
        $returned = $this->getObject()->getFileContent($file);
        $this->assertEquals($expected, $returned);
    }

    public function fileProvider()
    {
        return [
            [
                "cuentas.json",
                "[{\"company\":\"Facebook Inc.\",\"period\":2016,\"account\":\"Discontinued Operations(B)\",\"amount\":0}]"]
        ];
    }


    /**
     * @depends testGetFileContent
     */
    public function testProcess()
    {
        $returned = $this->getObject()->processJson(
            "[{\"company\":\"Facebook Inc.\",\"period\":2016,\"account\":\"Discontinued Operations(B)\",\"amount\":0}]"
        );

        $this->assertEquals("Facebook Inc.", $returned[0]->company);
        $this->assertEquals(2016, $returned[0]->period);
        $this->assertEquals("Discontinued Operations(B)", $returned[0]->account);
        $this->assertEquals(0, $returned[0]->amount);
    }
}
