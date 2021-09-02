<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Storage\ResumeUploader;
use EasySwoole\Oss\QiNiu\Storage\UploadManager;
use EasySwoole\Oss\QiNiu\Config;
use EasySwoole\Oss\QiNiu\Zone;

class ResumeUpTest extends QiNiuBaseTestCase
{
    protected $auth;

    protected function setUp():void
    {
        parent::setUp();
        $this->auth = $this->testAuth;
    }

    public function test4ML()
    {
        $key = 'resumePutFile4ML';
        $upManager = new UploadManager();
        $token = $this->auth->uploadToken($this->bucketName, $key);
        $tempFile = $this->qiniuTempFile(4 * 1024 * 1024 + 10);
        list($ret, $error) = $upManager->putFile($token, $key, $tempFile);
        $this->assertNull($error);
        $this->assertNotNull($ret['hash']);
        unlink($tempFile);
    }

    public function test4ML2()
    {
        $key = 'resumePutFile4ML';
        $zone = new Zone(array('upload.fake.qiniu.com'), array('upload.qiniup.com'));
        $cfg = new Config($zone);
        $upManager = new UploadManager($cfg);
        $token = $this->auth->uploadToken($this->bucketName, $key);
        $tempFile = $this->qiniuTempFile(4 * 1024 * 1024 + 10);
        list($ret, $error) = $upManager->putFile($token, $key, $tempFile);
        $this->assertNull($error);
        $this->assertNotNull($ret['hash']);
        unlink($tempFile);
    }

    // public function test8M()
    // {
    //     $key = 'resumePutFile8M';
    //     $upManager = new UploadManager();
    //     $token = $this->auth->uploadToken($this->bucketName, $key);
    //     $tempFile = qiniuTempFile(8*1024*1024+10);
    //     list($ret, $error) = $upManager->putFile($token, $key, $tempFile);
    //     $this->assertNull($error);
    //     $this->assertNotNull($ret['hash']);
    //     unlink($tempFile);
    // }
}
