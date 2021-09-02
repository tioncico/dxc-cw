<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/4/18 0018
 * Time: 11:27
 */

namespace App\Service\Common;

use App\Utility\Assert\Assert;
use App\Utility\OssClient;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\ORM\Db\MysqlPool;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Oss\AliYun\OssConst;
use EasySwoole\Utility\File;

class OssService
{
    use Singleton;

    const TEMP_FILE_PREFIX_PATH = 'temp/';
    const SIGN_EXPIRE = 30;


    public function getSts()
    {
        try {
            $data = OssClient::getInstance()->getStsToken();
            $data = json_decode($data, true);
            $result = [
                'StatusCode'      => 200,
                'AccessKeyId'     => $data['Credentials']['AccessKeyId'],
                'AccessKeySecret' => $data['Credentials']['AccessKeySecret'],
                'SecurityToken'   => $data['Credentials']['SecurityToken'],
                'Expiration'      => $data['Credentials']['Expiration'],
                'ossEndPoint'     => OssClient::getInstance()->getOssEndPoint(),
                'bucketName'      => OssClient::getInstance()->getOssBucket(),
            ];
        } catch (\Throwable $throwable) {
            $result = [
                'StatusCode'   => 500,
                'ErrorCode'    => $throwable->getCode(),
                'ErrorMessage' => $throwable->getMessage(),
            ];
        }
        return $result;
    }

    function gmtIso8601($time)
    {
        $dtStr = date('c', $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . "Z";
    }

    /**
     * getSign
     * web前端直传
     * @param null $dirPreFix
     * @return array
     * @author tioncico
     * Time: 下午5:05
     */
    public function getSign($dirPreFix = null)
    {
        $oss = new \App\Utility\OssClient();
        $id = $oss->getOssKey();          // 请填写您的AccessKeyId。
        $key = $oss->getOssSecret();     // 请填写您的AccessKeySecret。

        // $host的格式为 bucketname.endpoint，请替换为您的真实信息。
        $host = Config::getInstance()->getConf('ALI_OSS.HOST');
        Assert::assert(!!$host, 'ALI_OSS.HOST 不能为空');
        $dir = self::TEMP_FILE_PREFIX_PATH . date('His') . rand(100000, 999999);          // 用户上传文件时指定的前缀。
        $callbackParam = [
            'callbackUrl'      => $this->getCallbackUrl(),
            'callbackBody'     => 'filename=${object}&size=${size}&mimeType=${mimeType}&height=${imageInfo.height}&width=${imageInfo.width}',
            'callbackBodyType' => "application/x-www-form-urlencoded"
        ];
        $callbackString = json_encode($callbackParam);
        $base64CallbackBody = base64_encode($callbackString);

        $now = time();
        $expire = self::SIGN_EXPIRE;  //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问。
        $end = $now + $expire;
        $expiration = $this->gmtIso8601($end);
        $maxLength = Config::getInstance()->getConf('MAIN_SERVER.SETTING.package_max_length') ?? 2 * 2048;
        //最大文件大小.用户可以自己设置
        $condition = array(0 => 'content-length-range', 1 => 0, 2 => $maxLength);
        $conditions[] = $condition;

        // 表示用户上传的数据，必须是以$dir开始，不然上传会失败，这一步不是必须项，只是为了安全起见，防止用户通过policy上传到别人的目录。
//        $start = array(0 => 'starts-with', 1 => $key, 2 => $dir);
//        $conditions[] = $start;

        $arr = array('expiration' => $expiration, 'conditions' => $conditions);
        $policy = json_encode($arr);
        $base64Policy = base64_encode($policy);
        $stringToSign = $base64Policy;
        $signature = base64_encode(hash_hmac('sha1', $stringToSign, $key, true));

        $result = [];
        $result['accessid'] = $id;
        $result['host'] = $host;
        $result['policy'] = $base64Policy;
        $result['signature'] = $signature;
        $result['expire'] = $end;
        $result['callback'] = $base64CallbackBody;
        $result['dir'] = $dir;  // 这个参数是设置用户上传文件时指定的前缀。
        return $result;
    }

    static function ossCallback(\EasySwoole\Http\Request $request)
    {
// 2.获取OSS的签名
        $authorization = base64_decode($request->getHeader('authorization')[0]);
// 3.获取公钥
        $pubKeyUrl = base64_decode($request->getHeader('x-oss-pub-key-url')[0]);
        //先尝试本地是否有文件
        if (file_exists(EASYSWOOLE_ROOT . '/Temp/Oss/' . md5($pubKeyUrl))) {
            $pubKey = file_get_contents(EASYSWOOLE_ROOT . '/Temp/Oss/' . md5($pubKeyUrl));
        } else {
            $pubKey = file_get_contents($pubKeyUrl);
            File::createFile(EASYSWOOLE_ROOT . '/Temp/Oss/' . md5($pubKeyUrl), $pubKey);
        };

// 4.获取回调body
        $requestData = explode("\n", $request->getSwooleRequest()->getData());
        $body = $requestData[count($requestData) - 1];
// 5.拼接待签名字符串
        $authStr = '';
        $path = $request->getServerParams()['request_uri'];
        $pos = strpos($path, '?');
        if ($pos === false) {
            $authStr = urldecode($path) . "\n" . $body;
        } else {
            $authStr = urldecode(substr($path, 0, $pos)) . substr($path, $pos, strlen($path) - $pos) . "\n" . $body;
        }
// 6.验证签名
        return openssl_verify($authStr, $authorization, $pubKey, OPENSSL_ALGO_MD5);
    }

    /**
     * 移动oss临时文件
     * @param $filePath
     * @param $fileType
     * @return string|null
     * @throws \App\Utility\Assert\AssertException
     */
    static function moveFilePath($filePath, $fileType): ?string
    {

        //如果本身就为空,则不上传
        if (empty($filePath)) {
            return '';
        }
        //先验证文件是否为临时文件,如果不等于临时文件前缀,则不做移动
        if (substr($filePath, 0, strlen(self::TEMP_FILE_PREFIX_PATH)) != self::TEMP_FILE_PREFIX_PATH) {
            return null;
        }

        try {
            $ossClient = new OssClient();
            $path = $ossClient->copyFile($filePath, $fileType);
            $ossClient->aliOssClient()->putObjectAcl($ossClient->getOssBucket(), $path, OssConst::OSS_ACL_TYPE_PUBLIC_READ_WRITE);
            return $path;
        } catch (\Throwable $throwable) {
            Logger::getInstance()->log((string)$throwable);
            Assert::assert(false, '文件数据异常,请重新上传');
        }

    }

    /**
     * 删除临时文件
     * @param $filePath
     */
    static function delTempFile($filePath)
    {
        //如果本身就为空,则不上传
        if (empty($filePath)) {
            return '';
        }
        //先验证文件是否为临时文件,如果不等于临时文件前缀,则不做移动
        if (substr($filePath, 0, strlen(self::TEMP_FILE_PREFIX_PATH)) != self::TEMP_FILE_PREFIX_PATH) {
            return null;
        }

        $ossClient = new OssClient();
        $ossClient->delFile($filePath);
    }

    /**
     * 删除旧文件
     * @param $filePath
     */
    static function delFile($filePath)
    {
        $ossClient = new OssClient();
        if ($filePath) {
            $ossClient->delFile($filePath);
        }
    }


    static function splicingOssHost($str)
    {
        if ($str == null) {
            return null;
        }
        $host = Config::getInstance()->getConf('ALI_OSS')['HOST'] ?? '';
        return "{$host}/{$str}";
    }


    /**
     * 获取oss直传回调参数
     * getCallbackUrl
     * @return string
     * @throws \App\Utility\Assert\AssertException
     * @author tioncico
     * Time: 下午5:25
     */
    protected function getCallbackUrl()
    {
        $webHost = Config::getInstance()->getConf('WEB.HOST');
        Assert::assert(!!$webHost, 'webHost未配置!');
        $url = (Config::getInstance()->getConf('WEB.SSL') == true ? 'https://' : 'http://') . $webHost . '/Api/Common/FileCallback/fileCallback';
        return $url;
    }

    //获取视频第一帧
    static function videoFirstFrame($src)
    {
        $poster = $src . '?x-oss-process=video/snapshot,t_0000,f_jpg';
        return $poster;
    }

}
