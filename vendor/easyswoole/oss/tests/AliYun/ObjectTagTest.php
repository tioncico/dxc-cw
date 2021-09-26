<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;

require_once __DIR__ . '/Common.php';

class ObjectTagTest extends AliYunBaseTestCase
{
    public function testGetSet()
    {
        $client = Common::getOssClient();
        $bucket = Common::getBucketName();

        $object = 'test/object-tag';
        $client->deleteObject($bucket, $object);
        $client->putObject($bucket, $object, "hello world");

        try {
            $tagArr= ['a' => 1,'b'=>2];
            $response = $client->putObjectTagging($bucket, $object, $tagArr);
            $this->assertTrue(!!$response);
            $response = $client->getObjectTagging($bucket, $object);
            $this->assertEquals($response,$tagArr);
            $response = $client->deleteObjectTagging($bucket, $object);
            $this->assertEquals($response,[]);
            $response = $client->getObjectTagging($bucket, $object);
            $this->assertEquals($response,[]);

        } catch (OssException $e) {
            $this->assertFalse(True, $e->getMessage());
        }
    }
}
