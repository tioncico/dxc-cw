<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/14 0014
 * Time: 14:27
 */

namespace EasySwoole\Oss\AliYun\Http;

use EasySwoole\Oss\AliYun\Config;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

/**
 * 阿里云oss公共响应头封装
 * Class CommonRequestHeaders
 * @package EasySwoole\Oss\AliYun\Oss\Http
 */
class RequestHeaders
{
    protected $headers = [];
    protected $config;


    public function __construct(Config $config)
    {
        $headers = [
            OssConst::OSS_CONTENT_MD5  => '',
            OssConst::OSS_CONTENT_TYPE => '',
            OssConst::OSS_DATE         => gmdate('D, d M Y H:i:s \G\M\T'),
        ];
        $this->headers = $headers;
        $this->config = $config;
    }

    public function generateHeaders($options, $hostname, OssClient $ossClient)
    {
        $headers = $this->headers;

        if (isset($options[OssConst::OSS_DATE])) {
            $headers[OssConst::OSS_DATE] = $options[OssConst::OSS_DATE];
        }

        $headers[OssConst::OSS_HOST] = $hostname;
        if (isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $headers[OssConst::OSS_CONTENT_TYPE] = $options[OssConst::OSS_CONTENT_TYPE];
        }

        //content-md5
        if (isset($options[OssConst::OSS_CONTENT_MD5])) {
            $headers[OssConst::OSS_CONTENT_MD5] = $options[OssConst::OSS_CONTENT_MD5];
        }

        //添加stsSecurityToken
        if ((!is_null($ossClient->getSecurityToken())) && (!$ossClient->isEnableStsInUrl())) {
            $headers[OssConst::OSS_SECURITY_TOKEN] = $ossClient->getSecurityToken();
        }
        //合并HTTP headers
        if (isset($options[OssConst::OSS_HEADERS])) {
            $headers = array_merge($headers, $options[OssConst::OSS_HEADERS]);
            unset($headers[OssConst::OSS_HEADERS]);
        }
        $headers = $this->handelHeader($options, $headers);
        return $headers;
    }

    public function handelHeader($options, $headers)
    {
        if (isset($options[OssConst::OSS_CONTENT])) {

            if ($headers[OssConst::OSS_CONTENT_TYPE] === 'application/x-www-form-urlencoded') {
                $headers[OssConst::OSS_CONTENT_TYPE] = 'application/octet-stream';
            }
            $headers[OssConst::OSS_CONTENT_LENGTH] = strlen($options[OssConst::OSS_CONTENT]);
            $headers[OssConst::OSS_CONTENT_MD5] = base64_encode(md5($options[OssConst::OSS_CONTENT], true));
        }

        if (isset($options[OssConst::OSS_CALLBACK])) {
            $headers[OssConst::OSS_CALLBACK] = base64_encode($options[OssConst::OSS_CALLBACK]);
        }
        if (isset($options[OssConst::OSS_CALLBACK_VAR])) {
            $headers[OssConst::OSS_CALLBACK_VAR] = base64_encode($options[OssConst::OSS_CALLBACK_VAR]);
        }

        if (!isset($headers[OssConst::OSS_ACCEPT_ENCODING])) {
            $headers[OssConst::OSS_ACCEPT_ENCODING] = '';
        }
        $headers['Expect'] = '';
        return $headers;
    }


}
