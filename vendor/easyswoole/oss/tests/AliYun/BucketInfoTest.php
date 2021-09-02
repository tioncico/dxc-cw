<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Model\BucketInfo;

/**
 * Class BucketInfoTest
 * @package OSS\Tests
 */
class BucketInfoTest extends AliYunBaseTestCase
{
    public function testConstruct()
    {
        $bucketInfo = new BucketInfo('cn-beijing', 'name', 'today');
        $this->assertNotNull($bucketInfo);
        $this->assertEquals('cn-beijing', $bucketInfo->getLocation());
        $this->assertEquals('name', $bucketInfo->getName());
        $this->assertEquals('today', $bucketInfo->getCreateDate());
    }
}
