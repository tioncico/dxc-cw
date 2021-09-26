<?php

namespace EasySwoole\Oss\AliYun;

use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
    protected $accessKeyId;//appid
    protected $accessKeySecret;//key
    protected $endpoint;//point
    protected $isCName = false;//是否对Bucket做了域名绑定，并且Endpoint参数填写的是自己的域名

    /**
     * @return mixed
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * @param mixed $accessKeyId
     */
    public function setAccessKeyId($accessKeyId): void
    {
        $this->accessKeyId = $accessKeyId;
    }

    /**
     * @return mixed
     */
    public function getAccessKeySecret()
    {
        return $this->accessKeySecret;
    }

    /**
     * @param mixed $accessKeySecret
     */
    public function setAccessKeySecret($accessKeySecret): void
    {
        $this->accessKeySecret = $accessKeySecret;
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
     * @return bool
     */
    public function isCName(): bool
    {
        return $this->isCName;
    }

    /**
     * @param bool $isCName
     */
    public function setIsCName(bool $isCName): void
    {
        $this->isCName = $isCName;
    }


}
