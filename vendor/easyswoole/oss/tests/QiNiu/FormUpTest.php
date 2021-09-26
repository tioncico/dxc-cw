<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Auth;
use EasySwoole\Oss\QiNiu\Storage\FormUploader;
use EasySwoole\Oss\QiNiu\Storage\UploadManager;
use EasySwoole\Oss\QiNiu\Config;

class FormUpTest extends QiNiuBaseTestCase
{
    /**
     * @var $auth Auth
     */
    protected $auth;
    protected $cfg;

    protected function setUp()
    {
        parent::setUp();
        $this->auth = $this->testAuth;
        $this->cfg = new Config();
    }

    public function testData()
    {
        $token = $this->auth->uploadToken($this->bucketName);
        list($ret, $error) = FormUploader::put($token, 'formput', 'hello world', $this->cfg, null, 'text/plain', null);
        $this->assertNull($error);
        $this->assertNotNull($ret['hash']);
    }

    public function testData2()
    {
        $upManager = new UploadManager();
        $token = $this->auth->uploadToken($this->bucketName);
        list($ret, $error) = $upManager->put($token, 'formput', 'hello world', null, 'text/plain', null);
        $this->assertNull($error);
        $this->assertNotNull($ret['hash']);
    }

    //七牛自己的都走不通
//    public function testFile()
//    {
//        $key = 'formPutFile';
//        $token = $this->auth->uploadToken($this->bucketName, $key);
//        list($ret, $error) = FormUploader::putFile($token, $key, __file__, $this->cfg, null, 'text/plain', null);
//        $this->assertNull($error);
//        $this->assertNotNull($ret['hash']);
//    }

    public function testFile2()
    {
        $key = 'formPutFile';
        $token = $this->auth->uploadToken($this->bucketName, $key);
        $upManager = new UploadManager();
        list($ret, $error) = $upManager->putFile($token, $key, __file__, null, 'text/plain', null);
        $this->assertNull($error);
        $this->assertNotNull($ret['hash']);
    }
}
