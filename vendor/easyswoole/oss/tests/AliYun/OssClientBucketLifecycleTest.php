<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Model\LifecycleConfig;
use EasySwoole\Oss\AliYun\Model\LifecycleRule;
use EasySwoole\Oss\AliYun\Model\LifecycleAction;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssClientBucketLifecycleTest extends TestOssClientBase
{
    public function testBucket()
    {
        $lifecycleConfig = new LifecycleConfig();
        $actions = array();
        $actions[] = new LifecycleAction("Expiration", "Days", 3);
        $lifecycleRule = new LifecycleRule("delete obsoleted files", "obsoleted/", "Enabled", $actions);
        $lifecycleConfig->addRule($lifecycleRule);
        $actions = array();
        $actions[] = new LifecycleAction("Expiration", "Date", '2022-10-12T00:00:00.000Z');
        $lifecycleRule = new LifecycleRule("delete temporary files", "temporary/", "Enabled", $actions);
        $lifecycleConfig->addRule($lifecycleRule);

        try {
            $this->ossClient->putBucketLifecycle($this->bucket, $lifecycleConfig);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
            Common::waitMetaSync();
            $lifecycleConfig2 = $this->ossClient->getBucketLifecycle($this->bucket);
            $this->assertEquals($lifecycleConfig->serializeToXml(), $lifecycleConfig2->serializeToXml());
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
            Common::waitMetaSync();
            $this->ossClient->deleteBucketLifecycle($this->bucket);
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

        try {
            Common::waitMetaSync();
            $lifecycleConfig3 = $this->ossClient->getBucketLifecycle($this->bucket);
            $this->assertNotEquals($lifecycleConfig->serializeToXml(), $lifecycleConfig3->serializeToXml());
        } catch (OssException $e) {
            $this->assertTrue(false);
        }

    }
}
