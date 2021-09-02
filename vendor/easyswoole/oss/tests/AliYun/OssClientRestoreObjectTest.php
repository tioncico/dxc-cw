<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\Model\RestoreConfig;
use EasySwoole\Oss\AliYun\OssConst;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';


class OssClientRestoreObjectTest extends TestOssClientBase
{
    private $iaBucket;
    private $archiveBucket;

    public function testIARestoreObject()
    {
        $object = 'storage-object';

        $this->ossClient->putObject($this->iaBucket, $object,'testcontent');
        try{
            $this->ossClient->restoreObject($this->iaBucket, $object);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('400', $e->getHTTPStatus());
            $this->assertEquals('OperationNotSupported', $e->getErrorCode());
        }
    }

    public function testNullObjectRestoreObject()
    {
        $object = 'null-object';

        try{
            $this->ossClient->restoreObject($this->bucket, $object);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('404', $e->getHTTPStatus());
        }
    }

    public function testArchiveRestoreObject()
    {
        $object = 'storage-object';

        $this->ossClient->putObject($this->archiveBucket, $object,'testcontent');
        try{
            $this->ossClient->getObject($this->archiveBucket, $object);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('403', $e->getHTTPStatus());
            $this->assertEquals('InvalidObjectState', $e->getErrorCode());
        }
        $result = $this->ossClient->restoreObject($this->archiveBucket, $object);
        common::waitMetaSync();
        $this->assertEquals('202', $result['statusCode']);

        try{
            $this->ossClient->restoreObject($this->archiveBucket, $object);
        }catch(OssException $e){
            $this->assertEquals('409', $e->getHTTPStatus());
            $this->assertEquals('RestoreAlreadyInProgress', $e->getErrorCode());
        }
    }

    public function testColdArchiveRestoreObject()
    {

        $config = new \EasySwoole\Oss\AliYun\Config([
            'accessKeyId'     => ACCESS_KEY_ID,
            'accessKeySecret' => ACCESS_KEY_SECRET,
            'endpoint'        => "oss-ap-southeast-1.aliyuncs.com",
        ]);
        $client = new OssClient($config);

        $bucket = $this->bucket . 'cold-archive';
        $object = 'storage-object';

        //create bucket
        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_COLDARCHIVE
        );
        $client->createBucket($bucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);

        //test with days
        $client->putObject($bucket, $object,'testcontent');

        try{
            $client->getObject($bucket, $object);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('403', $e->getHTTPStatus());
            $this->assertEquals('InvalidObjectState', $e->getErrorCode());
        }

        $config = new RestoreConfig(5);
        $resoptions = array(
            OssConst::OSS_RESTORE_CONFIG => $config
        );
        try{
            $client->restoreObject($bucket, $object, $resoptions);
        }catch(OssException $e){
            $this->assertTrue(false);
        }

        try{
            $client->restoreObject($bucket, $object, $resoptions);
        }catch(OssException $e){
            $this->assertEquals('409', $e->getHTTPStatus());
            $this->assertEquals('RestoreAlreadyInProgress', $e->getErrorCode());
        }

        //test with days & tier
        $client->putObject($bucket, $object,'testcontent');

        try{
            $client->getObject($bucket, $object);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('403', $e->getHTTPStatus());
            $this->assertEquals('InvalidObjectState', $e->getErrorCode());
        }

        $config = new RestoreConfig(5, "Expedited");
        $resoptions = array(
            OssConst::OSS_RESTORE_CONFIG => $config
        );
        try{
            $client->restoreObject($bucket, $object, $resoptions);
        }catch(OssException $e){
            $this->assertTrue(false);
        }

        try{
            $client->restoreObject($bucket, $object, $resoptions);
        }catch(OssException $e){
            $this->assertEquals('409', $e->getHTTPStatus());
            $this->assertEquals('RestoreAlreadyInProgress', $e->getErrorCode());
        }

        $client->deleteObject($bucket, $object);
        $client->deleteBucket($bucket);
    }


    public function setUp():void
    {
        parent::setUp();

        $this->iaBucket = 'ia-' . $this->bucket;
        $this->archiveBucket = 'archive-' . $this->bucket;
        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_IA
        );

        $this->ossClient->createBucket($this->iaBucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);

        $options = array(
            OssConst::OSS_STORAGE => OssConst::OSS_STORAGE_ARCHIVE
        );

        $this->ossClient->createBucket($this->archiveBucket, OssConst::OSS_ACL_TYPE_PRIVATE, $options);
    }

    public function tearDown():void
    {
        parent::tearDown();

        $object = 'storage-object';

        $this->ossClient->deleteObject($this->iaBucket, $object);
        $this->ossClient->deleteObject($this->archiveBucket, $object);
        $this->ossClient->deleteBucket($this->iaBucket);
        $this->ossClient->deleteBucket($this->archiveBucket);
    }
}
