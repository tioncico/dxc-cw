<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\WormConfig;

/**
 * Class GetBucketWormResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketWormResult extends Result
{
    /**
     * Parse bucket stat data
     *
     * @return WormConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new WormConfig();
        $config->parseFromXml($content);
        return $config;
    }
}
