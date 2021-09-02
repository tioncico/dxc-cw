<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Model\LoggingConfig;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssClientBucketLoggingTest extends TestOssClientBase
{
    public function testBucket()
    {
        $loggingConfig = new LoggingConfig($this->bucket, 'prefix');
        try {
            $this->ossClient->putBucketLogging($this->bucket, $this->bucket, 'prefix');
        } catch (OssException $e) {
            var_dump($e->getMessage());
            $this->assertTrue(false);
        }
        try {
            Common::waitMetaSync();
            $loggingConfig2 = $this->ossClient->getBucketLogging($this->bucket);
            $this->assertEquals($loggingConfig->serializeToXml(), $loggingConfig2->serializeToXml());
        } catch (OssException $e) {
            $this->assertTrue(false);
        }
        try {
            Common::waitMetaSync();
            $this->ossClient->deleteBucketLogging($this->bucket);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }
        try {
            Common::waitMetaSync();
            $loggingConfig3 = $this->ossClient->getBucketLogging($this->bucket);
            $this->assertNotEquals($loggingConfig->serializeToXml(), $loggingConfig3->serializeToXml());
        } catch (OssException $e) {
            $this->assertTrue(false);
        }
    }
}
