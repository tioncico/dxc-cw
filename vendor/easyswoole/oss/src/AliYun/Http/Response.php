<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/14 0014
 * Time: 14:27
 */

namespace EasySwoole\Oss\AliYun\Http;


use EasySwoole\HttpClient\Bean\Response as HttpResponse;

/**
 * 阿里云oss公共响应封装
 * Class CommonRequestHeaders
 * @package EasySwoole\Oss\AliYun\Oss\Http
 */
class Response extends HttpResponse
{
    protected $ossRequestUrl;
    protected $ossRedirects;
    protected $ossStringToSign;
    protected $ossRequestHeaders;

    /**
     * @return mixed
     */
    public function getOssRequestUrl()
    {
        return $this->ossRequestUrl;
    }

    /**
     * @param mixed $ossRequestUrl
     */
    public function setOssRequestUrl($ossRequestUrl): void
    {
        $this->ossRequestUrl = $ossRequestUrl;
    }

    /**
     * @return mixed
     */
    public function getOssRedirects()
    {
        return $this->ossRedirects;
    }

    /**
     * @param mixed $ossRedirects
     */
    public function setOssRedirects($ossRedirects): void
    {
        $this->ossRedirects = $ossRedirects;
    }

    /**
     * @return mixed
     */
    public function getOssStringToSign()
    {
        return $this->ossStringToSign;
    }

    /**
     * @param mixed $ossStringToSign
     */
    public function setOssStringToSign($ossStringToSign): void
    {
        $this->ossStringToSign = $ossStringToSign;
    }

    /**
     * @return mixed
     */
    public function getOssRequestHeaders()
    {
        return $this->ossRequestHeaders;
    }

    /**
     * @param mixed $ossRequestHeaders
     */
    public function setOssRequestHeaders($ossRequestHeaders): void
    {
        $this->ossRequestHeaders = $ossRequestHeaders;
    }

}
