<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu;

class Crc32Test extends QiNiuBaseTestCase
{
    public function testData()
    {
        $a = '你好';
        $b = QiNiu\Util::crc32_data($a);
        $this->assertEquals('1352841281', $b);
    }

    public function testFile()
    {
        $b = QiNiu\Util::crc32_file(__file__);
        $c = QiNiu\Util::crc32_file(__file__);
        $this->assertEquals($c, $b);
    }
}
