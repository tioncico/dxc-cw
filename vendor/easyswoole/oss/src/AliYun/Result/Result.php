<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\Response;
use EasySwoole\Oss\AliYun\Http\ResponseHeaders;


/**
 * Class Result, 操作结果类的基类，不同的请求在处理返回数据的时候有不同的逻辑，
 * 具体的解析逻辑推迟到子类实现
 *
 * @package EasySwoole\Oss\AliYun\Model
 */
abstract class Result
{

    /**
     * 标示请求是否成功
     */
    protected $isOk = false;
    /**
     * 由子类解析过的数据
     */
    protected $parsedData = null;
    /**
     * 存放auth函数返回的原始Response
     *
     * @var Response
     */
    protected $rawResponse;

    /**
     * Result constructor.
     * @param $response Response
     * @throws OssException
     */
    public function __construct($response)
    {
        if ($response === null) {
            throw new OssException("raw response is null");
        }
        $this->rawResponse = $response;
        $this->parseResponse();
    }

    /**
     * 获取requestId
     *
     * @return string
     */
    public function getRequestId()
    {
        $headers = $this->rawResponse->getRequestHeaders();
        return $headers['x-oss-request-id'] ?? '';
    }

    /**
     * 得到返回数据，不同的请求返回数据格式不同
     *
     * $return mixed
     */
    public function getData()
    {
        return $this->parsedData;
    }

    /**
     * 由子类实现，不同的请求返回数据有不同的解析逻辑，由子类实现
     *
     * @return mixed
     */
    abstract protected function parseDataFromResponse();

    /**
     * 操作是否成功
     *
     * @return mixed
     */
    public function isOK()
    {
        return $this->isOk;
    }

    /**
     * @throws OssException
     */
    public function parseResponse()
    {
        $this->isOk = $this->isResponseOk();
        if ($this->isOk) {
            $this->parsedData = $this->parseDataFromResponse();
        } else {
            $httpStatus = strval($this->rawResponse->getStatusCode());
            $requestId = strval($this->getRequestId());
            $code = $this->retrieveErrorCode($this->rawResponse->getBody());
            $message = $this->retrieveErrorMessage($this->rawResponse->getBody());
            $body = $this->rawResponse->getBody();
            $details = array(
                'status'     => $httpStatus,
                'request-id' => $requestId,
                'code'       => $code??$this->rawResponse->getErrCode(),
                'message'    => $message??$this->rawResponse->getErrMsg(),
                'body'       => $body
            );
            throw new OssException($details);
        }
    }

    /**
     * 尝试从body中获取错误Message
     *
     * @param $body
     * @return string
     */
    private function retrieveErrorMessage($body)
    {
        if (empty($body) || false === strpos($body, '<?xml')) {
            return null;
        }
        $xml = simplexml_load_string($body);
        if (isset($xml->Message)) {
            return strval($xml->Message);
        }
        return null;
    }

    /**
     * 尝试从body中获取错误Code
     *
     * @param $body
     * @return string
     */
    private function retrieveErrorCode($body)
    {
        if (empty($body) || false === strpos($body, '<?xml')) {
            return null;
        }
        $xml = simplexml_load_string($body);
        if (isset($xml->Code)) {
            return strval($xml->Code);
        }
        return  null;
    }

    /**
     * 根据返回http状态码判断，[200-299]即认为是OK
     *
     * @return bool
     */
    protected function isResponseOk()
    {
        $status = $this->rawResponse->getStatusCode();
        if ((int)(intval($status) / 100) == 2) {
            return true;
        }
        return false;
    }

    /**
     * 返回原始的返回数据
     *
     * @return Response
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}
