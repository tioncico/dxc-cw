<?php
include "../../vendor/autoload.php";
include "../../phpunit2.php";
go(function (){
//config配置
    $config = new \EasySwoole\Oss\Tencent\Config([
        'appId'     => TX_APP_ID,
        'secretId'  => TX_SECRETID,
        'secretKey' => TX_SECRETKEY,
        'region'    => TX_REGION,
        'bucket'    => TX_BUCKET,
    ]);
    //new客户端
    $cosClient = new \EasySwoole\Oss\Tencent\OssClient($config);

    $key = '你好1331.txt';
    //生成一个文件数据
    $body = generateRandomString(2 * 1024  + 1023);
    //上传
    $cosClient->upload($bucket = TX_BUCKET,
        $key = $key,
        $body = $body,
        $options = ['PartSize' => 1024 + 1]
    );
    //获取文件内容
    $rt = $cosClient->getObject(['Bucket' => TX_BUCKET, 'Key' => $key,'SaveAs'=>'/www/easyswoole/tioncico_oss/1.txt']);
    var_dump($rt['Body']->__toString());
});


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}