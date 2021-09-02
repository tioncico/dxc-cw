<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\BucketStat;

/**
 * Class GetRefererResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketStatResult extends Result
{
    /**
     * Parse bucket stat data
     *
     * @return BucketStat
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $stat = new BucketStat();
        $stat->parseFromXml($content);
        return $stat;
    }
}
