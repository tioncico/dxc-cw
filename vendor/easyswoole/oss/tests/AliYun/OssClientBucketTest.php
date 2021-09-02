<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssClientBucketTest extends TestOssClientBase
{
    private $standardBucket;
    private $iaBucket;
    private $archiveBucket;

    public function testBucketWithInvalidName()
    {
        try {
            $this->ossClient->createBucket("s");
            $this->assertFalse(true);
        } catch (OssException $e) {
            $this->assertEquals('"s"bucket name is invalid', $e->getMessage());
        }
    }

    public function testBucketWithInvalidACL()
    {
        try {
            $this->ossClient->createBucket($this->bucket, "invalid");
            $this->assertFalse(true);
        } catch (OssException $e) {
            $this->assertEquals('invalid:acl is invalid(private,public-read,public-read-write)', $e->getMessage());
        }
    }

    public function testBucket()
    {
        $this->ossClient->createBucket($this->bucket, OssConst::OSS_ACL_TYPE_PUBLIC_READ_WRITE);

        $bucketListInfo = $this->ossClient->listBuckets();
        $this->assertNotNull($bucketListInfo);

        $bucketList = $bucketListInfo->getBucketList();
        $this->assertTrue(is_array($bucketList));
        $this->assertGreaterThan(0, count($bucketList));

        $this->ossClient->putBucketAcl($this->bucket, OssConst::OSS_ACL_TYPE_PUBLIC_READ_WRITE);
        Common::waitMetaSync();
        $this->assertEquals($this->ossClient->getBucketAcl($this->bucket), OssConst::OSS_ACL_TYPE_PUBLIC_READ_WRITE);

        $this->assertTrue($this->ossClient->doesBucketExist($this->bucket));
        $this->assertFalse($this->ossClient->doesBucketExist($this->bucket . '-notexist'));

        $this->assertEquals($this->ossClient->getBucketLocation($this->bucket), Common::getRegion());

        $res = $this->ossClient->getBucketMeta($this->bucket);

        $this->assertEquals('200', $res['statusCode']);
        $this->assertEquals(Common::getRegion(), $res['headers']['x-oss-bucket-region']);
    }

    public function  testCreateBucketWithStorageType()
    {
        $object = 'storage-object';

        $this->ossClient->putObject($this->archiveBucket, $object,'testcontent');
        try {
            $this->ossClient->getObject($this->archiveBucket, $object);
            $this->assertTrue(false);
        } catch (OssException $e) {
            $this->assertEquals('403', $e->getHTTPStatus());
            $this->assertEquals('InvalidObjectState', $e->getErrorCode());
        }

        $this->ossClient->putObject($this->iaBucket, $object,'testcontent');
        $result = $this->ossClient->getObject($this->iaBucket, $object);
        $this->assertEquals($result, 'testcontent');

        $this->ossClient->putObject($this->bucket, $object,'testcontent');
        $result = $this->ossClient->getObject($this->bucket, $object);
        $this->assertEquals($result, 'testcontent');
    }

    public function  testCreateBucketWithInvalidStorageType()
    {
        try {
            $options = array(
                OssConst::OSS_STORAGE => 'unknown'
            );
            $this->ossClient->createBucket('bucket-name', OssConst::OSS_ACL_TYPE_PRIVATE, $options);
            $this->assertTrue(false);
        } catch (OssException $e) {
            $this->assertTrue(true);
            if (strpos($e, "storage name is invalid") == false)
            {
                $this->assertTrue(false);
            }
        }
    }

    public function setUp():void
    {
        parent::setUp();

        $this->iaBucket = 'ia-' . $this->bucket;
        $this->archiveBucket = 'archive-' . $this->bucket;
        $this->standardBucket = 'standard-' . $this->bucket;

        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_IA
        );

        $this->ossClient->createBucket($this->iaBucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);

        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_ARCHIVE
        );

        $this->ossClient->createBucket($this->archiveBucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);

        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_STANDARD
        );

        $this->ossClient->createBucket($this->standardBucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);
    }

    public function tearDown():void
    {
        parent::tearDown();

        $object = 'storage-object';

        $this->ossClient->deleteObject($this->iaBucket, $object);
        $this->ossClient->deleteObject($this->archiveBucket, $object);
        $this->ossClient->deleteBucket($this->iaBucket);
        $this->ossClient->deleteBucket($this->archiveBucket);
        $this->ossClient->deleteBucket($this->standardBucket);
    }
}
