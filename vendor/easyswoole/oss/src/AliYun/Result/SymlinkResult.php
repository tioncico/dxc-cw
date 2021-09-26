<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\OssClient;
use EasySwoole\Oss\AliYun\OssConst;

/**
 *
 * @package EasySwoole\Oss\AliYun\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->getHeaders()[OssConst::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->getHeaders()[OssConst::OSS_SYMLINK_TARGET]);
        return $this->rawResponse->getHeaders();
    }
}

