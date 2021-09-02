<?php

namespace EasySwoole\Oss\Tencent;

use EasySwoole\HttpClient\Bean\Url;
use EasySwoole\HttpClient\Exception\InvalidUrl;
use EasySwoole\Oss\Tencent\Http\Command;
use EasySwoole\Oss\Tencent\Http\HttpClient;
use Psr\Http\Message\RequestInterface;
use EasySwoole\Oss\Tencent\TokenListener;


class CommandToRequestTransformer
{
    /**
     * @var $config Config
     */
    private $config;
    private $operation;

    public function __construct($config, $operation)
    {
        $this->config = $config;
        $this->operation = $operation;
    }

    // format bucket style
    public function bucketStyleTransformer(Command $command, HttpClient $request)
    {
        $action = $command->getName();
        $path = '';
        $operation = $this->operation;
        $httpMethod = $operation['httpMethod'];
        if ($action == 'ListBuckets') {
            $uri =  "service.cos.myqcloud.com";

            if ($this->config['endpoint'] != null) {
                $uri = $this->config['endpoint'];
            }
            if ($this->config['domain'] != null) {
                $uri = $this->config['domain'];
            }
            if ($this->config['ip'] != null) {
                $uri = $this->config['ip'];
                if ($this->config['port'] != null) {
                    $uri = $this->config['ip'] . ":" . $this->config['port'];
                }
            }
            $request->setUrl($this->config->getSchema()."://". $uri. "/");
            $request->setMethod($httpMethod);
            return $request;
        }
        $bucketName = $command['Bucket'];

        $appId = $this->config->getAppId();
        if ($appId != null && OssUtil::endWith($bucketName, '-' . $appId) == False) {
            $bucketName = $bucketName . '-' . $appId;
        }
        $command['Bucket'] = $bucketName;
        $uri = $operation['uri'];
        // Hoststyle is used by default
        // Pathstyle
        if ($this->config->getPathStyle() != true) {
            if (isset($operation['parameters']['Bucket']) && $command->hasParam('Bucket')) {
                $uri = str_replace("{Bucket}", '', $uri);
            }
            if (isset($operation['parameters']['Key']) && $command->hasParam('Key')) {
                $uri = str_replace("{/Key*}", OssUtil::encodeKey($command['Key']), $uri);
            }
        }

        $host = $bucketName . '.cos.' . $this->config->getRegion() . '.' . $this->config->getEndpoint();
        if ($this->config->getIp() != null) {
            $host = $this->config->getIp();
            if ($this->config->getPort() != null) {
                $host = $this->config->getIp() . ":" . $this->config->getPort();
            }
        }

        $path = $this->config->getSchema() . '://' . $host . $uri;

        $info = parse_url($path);
        if (empty($info['scheme'])) {
            $info = parse_url('//' . $path); // 防止无scheme导致的host解析异常 默认作为http处理
        }
        $uri = new Url($info);
        $query = $request->getUrl()->getQuery();
        if ($uri->getQuery() != $query && $uri->getQuery() != "") {
            $query = $uri->getQuery() . "&" . $query;
        }
        $uri->setQuery(OssUtil::filterQueryAndFragment((string)$query));

        $request->setUrl($uri);
        $request->setMethod($httpMethod);
        return $request;
    }

    // format upload body
    public function uploadBodyTransformer(Command $command, HttpClient $request, $bodyParameter = 'Body', $sourceParameter = 'SourceFile')
    {
        $operation = $this->operation;
        if (!isset($operation['parameters']['Body'])) {
            return $request;
        }
        $source = isset($command[$sourceParameter]) ? $command[$sourceParameter] : null;
        $body = isset($command[$bodyParameter]) ? $command[$bodyParameter] : null;
        // If a file path is passed in then get the file handle
        if (is_string($source) && file_exists($source)) {
            $body = fopen($source, 'rb');
        }
        // Prepare the body parameter and remove the source file parameter
        if (null !== $body) {
            return $request;
        } else {
            throw new InvalidUrl("You must specify a non-null value for the {$bodyParameter} or {$sourceParameter} parameters.");
        }
    }

    // update md5
    public function md5Transformer(Command $command, $request)
    {
        $operation = $this->operation;
        if (isset($operation['data']['contentMd5'])) {
            $request = $this->addMd5($request);
        }
        if (isset($operation['parameters']['ContentMD5']) &&
            isset($command['ContentMD5'])) {
            $value = $command['ContentMD5'];
            if ($value === true) {
                $request = $this->addMd5($request);
            }
        }

        return $request;
    }

    // count md5
    private function addMd5(HttpClient $request)
    {
        $body = $request->getRequestBody();
        if ($body && strlen($body) > 0) {
            $md5 = base64_encode(md5($body, true));
            return $request->setHeader('Content-MD5', $md5, false);
        }
        return $request;
    }

    // count md5
    public function addContentLength(HttpClient $request)
    {
        $body = $request->getRequestBody();
        if (($bodyLength = strlen($body)) >= 0) {
            return $request->setHeader('Content-Length', $bodyLength, false);
        }
        return $request;
    }

    // count md5
    public function specialParamTransformer(Command $command, HttpClient $request)
    {
        $action = $command->getName();
        if ($action == 'PutBucketInventory') {
            $id = $command['Id'];
            $uri = $request->getUrl();
            $query = $uri->getQuery();
            $uri->setQuery(OssUtil::filterQueryAndFragment($query . "&Id=" . $id));
            return $request->setUrl($uri);
        }
        return $request;
    }

    public function __destruct()
    {
    }

}
