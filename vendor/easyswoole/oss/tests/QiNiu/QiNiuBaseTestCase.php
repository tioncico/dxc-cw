<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/26 0026
 * Time: 13:51
 */

namespace EasySwoole\Oss\Tests\QiNiu;


use EasySwoole\Oss\QiNiu\Auth;
use PHPUnit\Framework\TestCase;

class QiNiuBaseTestCase extends TestCase
{
    protected $bucketName = 'tioncico';
    protected $key = 'psb.gif';
    protected $key2 = 'QQ图片20191127094033.jpg';
    protected $dummyAuth;
    /**
     * @var $testAuth Auth
     */
    protected $testAuth;

    protected function setUp():void
    {
        $this->testAuth = new Auth(QINIU_ACCESS_KEY, QINIU_SECRET_KEY);

        $dummyAccessKey = 'abcdefghklmnopq';
        $dummySecretKey = '1234567890';
        $this->dummyAuth = new Auth($dummyAccessKey, $dummySecretKey);

//cdn
        $timestampAntiLeechEncryptKey = getenv('QINIU_TIMESTAMP_ENCRPTKEY');
        $customDomain = "http://sdk.peterpy.cn";

        $tid = getenv('TRAVIS_JOB_NUMBER');
        if (!empty($tid)) {
            $pid = getmypid();
            $tid = strstr($tid, '.');
            $tid .= '.' . $pid;
        }
    }


    function qiniuTempFile($size)
    {
        $fileName = tempnam(sys_get_temp_dir(), 'qiniu_');
        $file = fopen($fileName, 'wb');
        if ($size > 0) {
            fseek($file, $size - 1);
            fwrite($file, ' ');
        }
        fclose($file);
        return $fileName;
    }
}
