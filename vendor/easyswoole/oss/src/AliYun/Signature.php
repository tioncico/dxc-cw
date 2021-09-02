<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/14 0014
 * Time: 14:39
 */

namespace EasySwoole\Oss\AliYun;

use EasySwoole\Oss\AliYun\Config;

class Signature
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }



    function getStringToSign($signableQueryString,$options, $headers,$hostType){
        $stringToSign = '';
        if (isset($options[OssConst::OSS_METHOD])) {
            $stringToSign .= $options[OssConst::OSS_METHOD] . "\n";
        }
        //header头组装
        uksort($headers, 'strnatcasecmp');
        foreach ($headers as $headerKey => $headerValue) {
            $headerValue = str_replace(array("\r", "\n"), '', $headerValue);
            $headerKey = strtolower($headerKey);
            if ($headerKey === 'content-md5' || $headerKey === 'content-type' || $headerKey === 'date' || (isset($options['OssConst::OSS_PREAUTH']) && (integer)$options['OssConst::OSS_PREAUTH'] > 0)) {
                $stringToSign .= $headerValue . "\n";
            } elseif (substr($headerKey, 0, 6) === OssConst::OSS_DEFAULT_PREFIX) {
                $stringToSign .= $headerKey . ':' . $headerValue . "\n";
            }
        }
        // 生成 signable_resource
        $signableResource = $this->generateSignableResource($options,$hostType);
        $stringToSign .= rawurldecode($signableResource) . urldecode($signableQueryString);
        return $stringToSign;
    }

    function getSign($stringToSignOrdered)
    {
        $signature = base64_encode(hash_hmac('sha1', $stringToSignOrdered, $this->config->getAccessKeySecret(), true));
        return $signature;
    }

    function generateSignableQueryStringParam($options, $enableStsInUrl, $securityToken)
    {
        $signableQueryStringParams = array();
        $signableList = [
            OssConst::OSS_PART_NUM,
            'response-content-type',
            'response-content-language',
            'response-cache-control',
            'response-content-encoding',
            'response-expires',
            'response-content-disposition',
            OssConst::OSS_UPLOAD_ID,
            OssConst::OSS_COMP,
            OssConst::OSS_LIVE_CHANNEL_STATUS,
            OssConst::OSS_LIVE_CHANNEL_START_TIME,
            OssConst::OSS_LIVE_CHANNEL_END_TIME,
            OssConst::OSS_PROCESS,
            OssConst::OSS_POSITION,
            OssConst::OSS_SYMLINK,
            OssConst::OSS_RESTORE,
            OssConst::OSS_TAGGING,
            OssConst::OSS_WORM_ID,
            OssConst::OSS_TRAFFIC_LIMIT,
            OssConst::OSS_VERSION_ID,
        ];
        //过滤其他参数
        foreach ($signableList as $item) {
            if (isset($options[$item])) {
                $signableQueryStringParams[$item] = $options[$item];
            }
        }
        //打开sts enable标志，使用户构造函数中传入的$sts生效
        if ($enableStsInUrl && (!is_null($securityToken))) {
            $signableQueryStringParams["security-token"] = $securityToken;
        }
        return $signableQueryStringParams;
    }


    /**
     *  生成用于签名resource段
     *
     * @param mixed $options
     * @return string
     */
    public function generateSignableResource($options, $hostType)
    {
        $signableResource = "";
        $signableResource .= '/';
        if (isset($options[OssConst::OSS_BUCKET]) && '' !== $options[OssConst::OSS_BUCKET]) {
            $signableResource .= $options[OssConst::OSS_BUCKET];
            // 如果操作没有Object操作的话，这里最后是否有斜线有个trick，ip的域名下，不需要加'/'， 否则需要加'/'
            if ($options[OssConst::OSS_OBJECT] == '/') {
                if ($hostType !== OssConst::OSS_HOST_TYPE_IP) {
                    $signableResource .= "/";
                }
            }
        }
        //signable_resource + object
        if (isset($options[OssConst::OSS_OBJECT]) && '/' !== $options[OssConst::OSS_OBJECT]) {
            $signableResource .= '/' . str_replace(array('%2F', '%25'), array('/', '%'), rawurlencode($options[OssConst::OSS_OBJECT]));
        }
        if (isset($options[OssConst::OSS_SUB_RESOURCE])) {
            $signableResource .= '?' . $options[OssConst::OSS_SUB_RESOURCE];
        }
        return $signableResource;
    }

    public function stringToSignSorted($stringToSign)
    {
        $queryStringSorted = '';
        $explodeResult = explode('?', $stringToSign);
        $index = count($explodeResult);
        if ($index === 1)
            return $stringToSign;

        $queryStringParams = explode('&', $explodeResult[$index - 1]);
        sort($queryStringParams);

        foreach ($queryStringParams as $params) {
            $queryStringSorted .= $params . '&';
        }

        $queryStringSorted = substr($queryStringSorted, 0, -1);

        return $explodeResult[0] . '?' . $queryStringSorted;
    }

}
