<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\TaggingConfig;

/**
 * Class GetBucketTagsResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketTagsResult extends Result
{
    /**
     *  Parse the TaggingConfig object from the response
     *
     * @return TaggingConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new TaggingConfig();
        $config->parseFromXml($content);
        return $config;
    }
}
