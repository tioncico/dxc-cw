<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Http\Client;

class HttpTest extends QiNiuBaseTestCase
{
    public function testGet()
    {
        $response = Client::get('http://baidu.com');
        $this->assertEquals($response->statusCode, 200);
        $this->assertNotNull($response->body);
        $this->assertEmpty($response->error);
    }

    public function testGetQiniu()
    {
        $response = Client::get('upload.qiniu.com');
        $this->assertEquals(405, $response->statusCode);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->xReqId());
        $this->assertNotNull($response->xLog());
        $this->assertNotEmpty($response->error);
    }

    public function testDelete()
    {
        $response = Client::delete('uc.qbox.me/bucketTagging', array());
        $this->assertEquals($response->statusCode, 401);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->error);
    }

    public function testDeleteQiniu()
    {
        $response = Client::delete('uc.qbox.me/bucketTagging', array());
        $this->assertEquals(401, $response->statusCode);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->xReqId());
        $this->assertNotNull($response->xLog());
        $this->assertNotNull($response->error);
    }

    public function testPost()
    {
        $response = Client::post('qiniu.com', null);
        $this->assertEquals($response->statusCode, 200);
        $this->assertNotNull($response->body);
        $this->assertNotEmpty($response->error);
    }

    public function testPostQiniu()
    {
        $response = Client::post('upload.qiniu.com', null);
        $this->assertEquals($response->statusCode, 400);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->xReqId());
        $this->assertNotNull($response->xLog());
        $this->assertNotEmpty($response->error);
    }


    public function testPut()
    {
        $response = Client::PUT('uc.qbox.me/bucketTagging', null);
        $this->assertEquals($response->statusCode, 401);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->error);
    }

    public function testPutQiniu()
    {
        $response = Client::put('uc.qbox.me/bucketTagging', null);
        $this->assertEquals(401, $response->statusCode);
        $this->assertNotNull($response->body);
        $this->assertNotNull($response->xReqId());
        $this->assertNotNull($response->xLog());
        $this->assertNotNull($response->error);
    }
}
