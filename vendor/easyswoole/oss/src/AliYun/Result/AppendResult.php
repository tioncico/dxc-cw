<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;

/**
 * Class AppendResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class AppendResult extends Result
{
    /**
     * 结果中part的next-append-position
     *
     * @return int
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->getHeaders();
        if (isset($header["x-oss-next-append-position"])) {
            return intval($header["x-oss-next-append-position"]);
        }
        throw new OssException("cannot get next-append-position");
    }
}