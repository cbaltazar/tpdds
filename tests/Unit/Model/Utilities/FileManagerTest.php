<?php

use PHPUnit\Framework\TestCase;
use App\Model\Utilities\FileManager;

class FileManagerTest extends TestCase
{
    private $object;
    private $dm;

    protected function setUp()
    {
        $this->dm = Mockery::mock('App\Model\Domain\AccountManager');
        $this->object = new FileManager($this->dm);
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
                __DIR__ . DIRECTORY_SEPARATOR.'cuentas.json',
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
