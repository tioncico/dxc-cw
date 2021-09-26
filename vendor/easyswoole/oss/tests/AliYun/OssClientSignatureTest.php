<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\HttpClient;
use EasySwoole\Oss\AliYun\Http\RequestCore;
use EasySwoole\Oss\AliYun\Http\Response;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssClientSignatureTest extends TestOssClientBase
{
    function testGetSignedUrlForGettingObject()
    {
        $object = "a.file";
        $this->ossClient->putObject($this->bucket, $object, file_get_contents(__FILE__));
        $timeout = 3600;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }
        $request = new HttpClient($signedUrl);
        $response = $request->get();

        $this->assertEquals(file_get_contents(__FILE__), $response->getBody());
    }

    public function testGetSignedUrlForPuttingObject()
    {
        $object = "a.file";
        $timeout = 3600;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "PUT");
            $content = file_get_contents(__FILE__);

            $request = new HttpClient($signedUrl);

            $response = $request->put($content, [
                'Content-Type'   => '',
                'Content-Length' => strlen($content)
            ]);
            $this->assertTrue(substr($response->getStatusCode(), 0, 1) == 2);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }
    }

    public function testGetSignedUrlForPuttingObjectFromFile()
    {
        $file = __FILE__;
        $object = "a.file";
        $timeout = 3600;
        $options = array('Content-Type' => 'txt');
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "PUT", $options);
            $request = new HttpClient($signedUrl);
            $response = $request->put(file_get_contents($file), ['Content-Type' => 'txt']);
            var_dump($response);
            $this->assertTrue(substr($response->getStatusCode(), 0, 1) == 2);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }

    }

    public function testSignedUrlWithException()
    {
        $file = __FILE__;
        $object = "a.file";
        $timeout = 3600;
        $options = array('Content-Type' => 'txt');
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "POST", $options);
            $this->assertTrue(false);
        } catch (OssException $e) {
            $this->assertTrue(true);
            if (strpos($e, "method is invalid") == false) {
                $this->assertTrue(false);
            }
        }
    }

    function testGetgenPreSignedUrlForGettingObject()
    {
        $object = "a.file";
        $this->ossClient->putObject($this->bucket, $object, file_get_contents(__FILE__));
        $expires = time() + 3600;
        try {
            $signedUrl = $this->ossClient->generatePresignedUrl($this->bucket, $object, $expires);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }

        $request = new HttpClient($signedUrl);

        $response = $request->get(['Content-Type' => '']);
        $this->assertEquals(file_get_contents(__FILE__), $response->getBody());
    }

    function testGetgenPreSignedUrlVsSignedUrl()
    {
        $object = "object-vs.file";
        $signedUrl1 = '245';
        $signedUrl2 = '123';
        $expiration = 0;

        do {
            usleep(500000);
            $begin = time();
            $expiration = time() + 3600;
            $signedUrl1 = $this->ossClient->generatePresignedUrl($this->bucket, $object, $expiration);
            $signedUrl2 = $this->ossClient->signUrl($this->bucket, $object, 3600);
            $end = time();
        } while ($begin != $end);
        $this->assertEquals($signedUrl1, $signedUrl2);
        $this->assertTrue(strpos($signedUrl1, 'Expires=' . $expiration) !== false);
    }

    public function tearDown(): void
    {
        $this->ossClient->deleteObject($this->bucket, "a.file");
        parent::tearDown();
    }

    public function setUp(): void
    {
        parent::setUp();
        /**
         *  上传本地变量到bucket
         */
        $object = "a.file";
        $content = file_get_contents(__FILE__);
        $options = array(
            OssConst::OSS_LENGTH  => strlen($content),
            OssConst::OSS_HEADERS => array(
                'Expires'                      => 'Fri, 28 Feb 2020 05:38:42 GMT',
                'Cache-Control'                => 'no-cache',
                'Content-Disposition'          => 'attachment;filename=oss_download.log',
                'Content-Encoding'             => 'utf-8',
                'Content-Language'             => 'zh-CN',
                'x-oss-server-side-encryption' => 'AES256',
                'x-oss-meta-self-define-title' => 'user define meta info',
            ),
        );

        try {
            $this->ossClient->putObject($this->bucket, $object, $content, $options);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }
    }
}
