<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Processing\Operation;
use EasySwoole\Oss\QiNiu\Processing\PersistentFop;
use EasySwoole\Oss\QiNiu\Util;

class PfopTest extends QiNiuBaseTestCase
{
    public function testPfop()
    {
        $testAuth = $this->testAuth;
        $bucket = 'testres';
        $key = 'sintel_trailer.mp4';
        $pfop = new PersistentFop($testAuth, null);

        $fops = 'avthumb/m3u8/segtime/10/vcodec/libx264/s/320x240';
        list($id, $error) = $pfop->execute($bucket, $key, $fops);
        $this->assertNull($error);
        list($status, $error) = $pfop->status($id);
        $this->assertNotNull($status);
        $this->assertNull($error);
    }


    public function testPfops()
    {
        $testAuth = $this->testAuth;
        $bucket = 'testres';
        $key = 'sintel_trailer.mp4';
        $fops = array(
            'avthumb/m3u8/segtime/10/vcodec/libx264/s/320x240',
            'vframe/jpg/offset/7/w/480/h/360',
        );
        $pfop = new PersistentFop($testAuth, null);

        list($id, $error) = $pfop->execute($bucket, $key, $fops);
        $this->assertNull($error);

        list($status, $error) = $pfop->status($id);
        $this->assertNotNull($status);
        $this->assertNull($error);
    }

    public function testMkzip()
    {
        $testAuth = $this->testAuth;
        $bucket = 'phpsdk';
        $key = 'php-logo.png';
        $pfop = new PersistentFop($testAuth, null);

        $url1 = 'http://phpsdk.qiniudn.com/php-logo.png';
        $url2 = 'http://phpsdk.qiniudn.com/php-sdk.html';
        $zipKey = 'test.zip';

        $fops = 'mkzip/2/url/' . Util::base64_urlSafeEncode($url1);
        $fops .= '/url/' . Util::base64_urlSafeEncode($url2);
        $fops .= '|saveas/' . Util::base64_urlSafeEncode("$bucket:$zipKey");

        list($id, $error) = $pfop->execute($bucket, $key, $fops);
        $this->assertNull($error);

        list($status, $error) = $pfop->status($id);
        $this->assertNotNull($status);
        $this->assertNull($error);
    }
}
