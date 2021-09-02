<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;

/**
 * Class InitiateBucketWormResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class InitiateBucketWormResult extends Result
{
    /**
     * Get the value of worm-id from response headers
     *
     * @return int
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->getHeaders();
        if (isset($header["x-oss-worm-id"])) {
            return strval($header["x-oss-worm-id"]);
        }
        throw new OssException("cannot get worm-id");
    }
}
