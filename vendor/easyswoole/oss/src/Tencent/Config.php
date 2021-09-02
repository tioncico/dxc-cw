<?php

namespace EasySwoole\Oss\Tencent;

use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
    protected $schema = 'http';//http
    protected $endpoint = 'myqcloud.com';//节点
    protected $region = '';//地区
    protected $appId=null;//appid
    protected $secretId="";//secretId
    protected $secretKey="";//key
    protected $anonymous=false;//匿名
    protected $token="";//token
    protected $timeout=3600;//超时时间
    protected $connectTimeout;//连接超时时间
    protected $ip=null;//ip
    protected $port=null;//端口
    protected $proxy= null;//是否代理 http代理 $proxy=['127.0.0.1','8080','user','pass']
    protected $userAgent='easyswoole/httpClient';//ua标识
    protected $pathStyle=false;

    /**
     * @return mixed
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param mixed $schema
     */
    public function setSchema($schema): void
    {
        $this->schema = $schema;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {

        $regionMap = array('cn-east'      => 'ap-shanghai',
                           'cn-south'     => 'ap-guangzhou',
                           'cn-north'     => 'ap-beijing-1',
                           'cn-south-2'   => 'ap-guangzhou-2',
                           'cn-southwest' => 'ap-chengdu',
                           'sg'           => 'ap-singapore',
                           'tj'           => 'ap-beijing-1',
                           'bj'           => 'ap-beijing',
                           'sh'           => 'ap-shanghai',
                           'gz'           => 'ap-guangzhou',
                           'cd'           => 'ap-chengdu',
                           'sgp'          => 'ap-singapore');
        if (array_key_exists($region, $regionMap)) {

            $this->region = $regionMap[$region];
        }
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return mixed
     */
    public function getSecretId()
    {
        return $this->secretId;
    }

    /**
     * @param mixed $secretId
     */
    public function setSecretId($secretId): void
    {
        $this->secretId = $secretId;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param mixed $secretKey
     */
    public function setSecretKey($secretKey): void
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return mixed
     */
    public function getAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * @param mixed $anonymous
     */
    public function setAnonymous($anonymous): void
    {
        $this->anonymous = $anonymous;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param mixed $timeout
     */
    public function setTimeout($timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @return mixed
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * @param mixed $connect_timeout
     */
    public function setConnectTimeout($connect_timeout): void
    {
        $this->connectTimeout = $connect_timeout;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port): void
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @param mixed $proxy
     */
    public function setProxy($proxy): void
    {
        $this->proxy = $proxy;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param mixed $userAgent
     */
    public function setUserAgent($userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return mixed
     */
    public function getPathStyle()
    {
        return $this->pathStyle;
    }

    /**
     * @param mixed $pathStyle
     */
    public function setPathStyle($pathStyle): void
    {
        $this->pathStyle = $pathStyle;
    }//路径类型


    function encodeKey($key)
    {
        return str_replace('%2F', '/', rawurlencode($key));
    }

    function endWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }


}
