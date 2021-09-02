<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/20 0020
 * Time: 17:55
 */

namespace EasySwoole\Oss\AliYun\Http;


use EasySwoole\Oss\AliYun\OssConst;
use EasySwoole\Oss\BaseOssClient;
use Swoole\Coroutine\Http\Client;


class HttpClient extends BaseOssClient
{

    /**
     * 默认请求头
     * @var array
     */
    protected $header = [
        'Accept'          => '*/*',
//        'accept-encoding' => '',
    ];
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

    public function downFile(string $filename, int $offset = 0,$httpMethod = null)
    {
        $client = $this->getClient();
        //预处理。合并cookie 和header
        $this->setMethod($httpMethod??$client->requestMethod);
        $client->setCookies((array)$this->cookies + (array)$client->cookies);
        $client->setHeaders($this->header);
        $response = $client->download($this->url->getFullPath(), $filename, $offset);
        return $response ? $this->createHttpResponse($client) : false;
    }

    /**
     * 生成一个响应结构体
     * @param Client $client
     * @return Response
     */
    private function createHttpResponse(Client $client): Response
    {
        $response = new Response((array)$client);
        $response->setClient($client);
        return $response;
    }
}