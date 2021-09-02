<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/26 0026
 * Time: 10:26
 */

namespace EasySwoole\Oss\Tencent\Http;

use EasySwoole\HttpClient\Bean\Url;
use EasySwoole\Oss\BaseOssClient;

class HttpClient extends BaseOssClient
{
    /**
     * @var $requestBody //自行记录的发送body
     */
    protected $requestBody;

    /**
     * 发起请求
     * request
     * @return mixed
     * @author Tioncico
     * Time: 9:32
     */
    public function request()
    {
        $method = strtolower($this->getClient()->requestMethod);
        $response = $this->$method();
        return $response;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    function setUrl($url): BaseOssClient
    {
        if (is_string($url)) {
            return parent::setUrl($url);
        } elseif ($url instanceof Url) {
            $this->url = $url;
            return $this;
        }
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @param mixed $requestBody
     */
    public function setRequestBody($requestBody): void
    {
        $this->requestBody = $requestBody;
    }


}