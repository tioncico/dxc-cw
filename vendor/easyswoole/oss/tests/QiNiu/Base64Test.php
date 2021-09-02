<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu;

class Base64Test extends QiNiuBaseTestCase
{
    public function testUrlSafe()
    {
        $a = '你好';
        $b = QiNiu\Util::base64_urlSafeEncode($a);
        $this->assertEquals($a, QiNiu\Util::base64_urlSafeDecode($b));
    }
}
