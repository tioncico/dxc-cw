<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\OssClient;


class OssClientTest extends TestOssClientBase
{
    public function testConstrunct()
    {
        try {
            $config = new \EasySwoole\Oss\AliYun\Config([
                'accessKeyId'     => ACCESS_KEY_ID,
                'accessKeySecret' => ACCESS_KEY_SECRET,
                'endpoint'        => 'http://oss-cn-hangzhou.aliyuncs.com',
            ]);
            $ossClient = new OssClient($config);
            $this->assertFalse($ossClient->isUseSSL());
            $ossClient->setUseSSL(true);
            $this->assertTrue($ossClient->isUseSSL());
            $this->assertTrue(true);
            $this->assertEquals(3, $ossClient->getMaxRetries());
            $ossClient->setMaxTries(4);
            $this->assertEquals(4, $ossClient->getMaxRetries());
//            $ossClient->setTimeout(10);
//            $ossClient->setConnectTimeout(20);
        } catch (OssException $e) {
            $this->assertFalse(true);
        }
    }
}
