<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

/**
 * Class Common
 *
 * Sample program [Samples / *. Php] Common class, used to obtain OssClient instance and other public methods
 */
class Common
{
    /**
     * According to the Config configuration, get an OssClient instance
     *
     * @return OssClient  An OssClient instance
     */
    public static function getOssClient()
    {
        try {

            $config = new \EasySwoole\Oss\AliYun\Config([
                'accessKeyId'     => ACCESS_KEY_ID,
                'accessKeySecret' => ACCESS_KEY_SECRET,
                'endpoint'        => END_POINT,
            ]);
            $ossClient = new OssClient($config);

//            $ossClient = new \OSS\OssClient(ACCESS_KEY_ID, ACCESS_KEY_SECRET, END_POINT);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }

    public static function getBucketName()
    {
        return OSS_BUCKET;
    }

    public static function getRegion()
    {
		return OSS_REGION;
    }

	public static function getCallbackUrl()
    {
        return OSS_CALLBACK_URL;
    }

    /**
     * Tool method, create a bucket
     */
    public static function createBucket()
    {
        $ossClient = self::getOssClient();
        if (is_null($ossClient)) exit(1);
        $bucket = self::getBucketName();
        $acl = OssConst::OSS_ACL_TYPE_PUBLIC_READ;
        try {
            $ossClient->createBucket($bucket, $acl);
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . ": OK" . "\n");
    }

    /**
     * Wait for bucket meta sync
     */
    public static function waitMetaSync()
    {
        if (getenv('TRAVIS')) {
            sleep(10);
        }
    }
}
