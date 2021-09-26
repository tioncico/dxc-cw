<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\HttpClient;
use EasySwoole\Oss\AliYun\Http\RequestCore;
use EasySwoole\Oss\AliYun\Http\Response;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssTrafficLimitTest extends TestOssClientBase
{
    function testTrafficLimitInHeader()
    {
        $options = array(
            OssConst::OSS_HEADERS => array(
                OssConst::OSS_TRAFFIC_LIMIT => 819200,
        ));

        try {
            $result = $this->ossClient->putObject($this->bucket, 'default-object', 'content', $options);
            $this->assertTrue(true);
            $this->assertTrue(isset($result["x-oss-qos-delay-time"]));
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
    		$result = $this->ossClient->appendObject($this->bucket, 'append-object', 'content', 0, $options);
            $this->assertTrue(true);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
    		$result = $this->ossClient->copyObject($this->bucket, 'default-object', $this->bucket, 'copy-object', $options);
            $this->assertTrue(true);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
            $result = $this->ossClient->getObject($this->bucket, 'default-object', $options);
            $this->assertTrue(true);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }
    }

    function testTrafficLimitInQuery()
    {
        $options = array(
            OssConst::OSS_TRAFFIC_LIMIT => 819200,
        );

        $object = "get.file";
        $content = 'hello world';
        $this->ossClient->putObject($this->bucket, $object, $content);
        $timeout = 3600;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "GET", $options);
            $this->assertTrue(stripos($signedUrl, 'x-oss-traffic-limit=819200') > 0);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }

        $request = new HttpClient($signedUrl);
        $res =   $request->get(['Content-Type'=>'']);
        $this->assertEquals($content, $res->getBody());


        $object = "put.file";
        $timeout = 3600;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "PUT", $options);
            $this->assertTrue(stripos($signedUrl, 'x-oss-traffic-limit=819200') > 0);

            $request = new HttpClient($signedUrl);
            $res =   $request->put($content,['Content-Length'=>strlen($content),'Content-Type'=> '']);
            $this->assertTrue(substr($res->getStatusCode(), 0, 1) == 2);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }
    }
}
