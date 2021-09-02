<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\Result\SymlinkResult;
use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\Response;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestOssClientBase.php';

class SymlinkTest extends TestOssClientBase
{
    public function testPutSymlink()
    {
        $bucket = $this->bucket;
        $symlink = 'test-link';
        $special_object = 'exist_object^$#!~';
        $object = 'exist_object';

        $this->ossClient ->putObject($bucket, $object, 'test_content');
        $this->ossClient->putSymlink($bucket, $symlink, $object);
        $result = $this->ossClient->getObject($bucket, $symlink);
        $this->assertEquals('test_content', $result);

        $this->ossClient ->putObject($bucket, $special_object, 'test_content');
        $this->ossClient->putSymlink($bucket, $symlink, $special_object);
        $result = $this->ossClient->getObject($bucket, $symlink);
        $this->assertEquals('test_content', $result);
    }

    public function testGetSymlink()
    {
        $bucket = $this->bucket;
        $symlink = 'test-link';
        $object = 'exist_object^$#!~';

        $this->ossClient ->putObject($bucket, $object, 'test_content');
        $this->ossClient->putSymlink($bucket, $symlink, $object);

        $result = $this->ossClient->getSymlink($bucket, $symlink);
        $this->assertEquals($result[OssConst::OSS_SYMLINK_TARGET], $object);
        $this->assertEquals('200', $result[OssConst::OSS_INFO][OssConst::OSS_HTTP_CODE]);
        $this->assertTrue(isset($result[OssConst::OSS_ETAG]));
        $this->assertTrue(isset($result[OssConst::OSS_REQUEST_ID]));
    }

    public function testPutNullSymlink()
    {
        $bucket = $this->bucket;
        $symlink = 'null-link';
        $object_not_exist = 'not_exist_object+$#!b不';
        $this->ossClient->putSymlink($bucket, $symlink, $object_not_exist);

        try{
            $this->ossClient->getObject($bucket, $symlink);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('The symlink target object does not exist', $e->getErrorMessage());
        }
    }

    public function testGetNullSymlink()
    {
        $bucket = $this->bucket;
        $symlink = 'null-link-new';

        try{
            $result = $this->ossClient->getSymlink($bucket, $symlink);
            $this->assertTrue(false);
        }catch (OssException $e){
            $this->assertEquals('The specified key does not exist.', $e->getErrorMessage());
        }
    }
}


