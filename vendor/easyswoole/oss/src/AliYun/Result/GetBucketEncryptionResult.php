<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\ServerSideEncryptionConfig;

/**
 * Class GetBucketEncryptionResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketEncryptionResult extends Result
{
    /**
     *  Parse the ServerSideEncryptionConfig object from the response
     *
     * @return ServerSideEncryptionConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new ServerSideEncryptionConfig();
        $config->parseFromXml($content);
        return $config;
    }
}
