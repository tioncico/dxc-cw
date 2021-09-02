<?php

namespace EasySwoole\Oss\Tests\Tencent;

use EasySwoole\Oss\Tencent\Client;
use EasySwoole\Oss\Tencent\Config;

class TestHelper {

    public static function nuke($bucket) {
        try {
            $config = new Config([
                'appId'     => TX_APP_ID,
                'secretId'  => TX_SECRETID,
                'secretKey' => TX_SECRETKEY,
                'region'    => TX_REGION,
                'bucket' => $bucket
            ]);

            $cosClient = new \EasySwoole\Oss\Tencent\OssClient($config);
            $result = $cosClient->listObjects(array('Bucket' => $bucket));
            if (isset($result['Contents'])) {
                foreach ($result['Contents'] as $content) {
                    $cosClient->deleteObject(array('Bucket' => $bucket, 'Key' => $content['Key']));
                }
            }

            while(True){
                $result = $cosClient->ListMultipartUploads(
                    array('Bucket' => $bucket));
                if (count($result['Uploads']) == 0){
                    break;
                }
                foreach ($result['Uploads'] as $upload) {
                    try {
                        $rt = $cosClient->AbortMultipartUpload(
                            array('Bucket' => $bucket,
                                'Key' => $upload['Key'],
                                'UploadId' => $upload['UploadId']));
                    } catch (\Exception $e) {
//                        print_r($e);
                    }
                }
            }        
            $cosClient->deleteBucket(array('Bucket' => $bucket));
        } catch (\Exception $e) {
            // echo "$e\n";
        }
    }
}
