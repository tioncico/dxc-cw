<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Http\Client;

class DownloadTest extends QiNiuBaseTestCase
{
    public function test()
    {
        $testAuth = $this->testAuth;
        $base_url = 'http://sdk.peterpy.cn/gogopher.jpg';
        $private_url = $testAuth->privateDownloadUrl($base_url);
        $response = Client::get($private_url);
        $this->assertEquals(200, $response->statusCode);
    }

    public function testFop()
    {
        $testAuth = $this->testAuth;
        $base_url = 'http://sdk.peterpy.cn/gogopher.jpg?exif';
        $private_url = $testAuth->privateDownloadUrl($base_url);
        $response = Client::get($private_url);
        $this->assertEquals(200, $response->statusCode);
    }
}
