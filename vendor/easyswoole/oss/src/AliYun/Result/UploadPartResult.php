<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;

/**
 * Class UploadPartResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class UploadPartResult extends Result
{
    /**
     * 结果中part的ETag
     *
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->getHeaders();
        if (isset($header["etag"])) {
            return $header["etag"];
        }
        throw new OssException("cannot get ETag");

    }
}