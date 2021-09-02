<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/5 0005
 * Time: 14:07
 */

namespace EasySwoole\Oss\Tencent\Request;


use EasySwoole\Oss\Tencent\Http\HttpClient;
use EasySwoole\Oss\Tencent\OssUtil;

class QueryHandel
{
    /**
     * @var $request HttpClient
     */
    protected $request;
    protected $operation;
    protected $args;

    public function __construct($request, $operation, $args)
    {
        $this->request = $request;
        $this->operation = $operation;
        $this->args = $args;
    }

    /**
     * @return HttpClient
     */
    public function getRequest(): HttpClient
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }


    function handelParam($key, $param, $op)
    {
        $keyName = $op['sentAs'] ?? $key;
        $url = $this->request->getUrl();
        if (empty($url->getQuery())) {
            $queryStr = "$keyName=$param";
        } else {
            $queryStr = $url->getQuery()."&$keyName=$param";
        }
        $url->setQuery(OssUtil::filterQueryAndFragment((string)$queryStr));
        $this->request->setUrl($url);
    }
}