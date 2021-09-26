<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/3 0003
 * Time: 9:40
 */
include "../../vendor/autoload.php";
include "../../phpunit2.php";


$client = new \Qcloud\Cos\Client(
    [
        'region'      => TX_REGION,
        'credentials' => [
            'appId'     => TX_APP_ID,
            'secretId'  => TX_SECRETID,
            'secretKey' => TX_SECRETKEY
        ]
    ]
);

try {
    $src_key = '你好.txt';
    $dst_key = 'hi.txt';
    $body = generateRandomString(2 * 1024 * 1024 + 333);
    $md5 = base64_encode(md5($body, true));
    $client->upload($bucket = TX_BUCKET,
        $key = $src_key,
        $body = $body,
        $options = ['PartSize' => 1024 * 1024 + 1]);

    $client->copy($bucket = TX_BUCKET,
        $key = $dst_key,
        $copySource = ['Bucket' => TX_BUCKET,
                       'Region' => TX_REGION,
                       'Key'    => $src_key],
        $options = ['PartSize' => 1024 * 1024 + 1]);

    $rt = $client->getObject(['Bucket' => TX_BUCKET, 'Key' => $dst_key]);
    $download_md5 = base64_encode(md5($rt['Body'], true));
} catch (\Qcloud\Cos\Exception\ServiceResponseException $e) {
    print $e;
}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}