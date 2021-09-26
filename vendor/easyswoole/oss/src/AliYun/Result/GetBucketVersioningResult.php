<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\VersioningConfig;

/**
 * Class GetBucketVersioningResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketVersioningResult extends Result
{
    /**
     *  Parse the VersioningConfig object from the response
     *
     * @return VersioningConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new VersioningConfig();
        $config->parseFromXml($content);
        return $config->getStatus();
    }
}
