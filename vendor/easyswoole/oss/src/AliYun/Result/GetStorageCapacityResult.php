<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;

/**
 * Class AclResult getBucketAcl接口返回结果类，封装了
 * 返回的xml数据的解析
 *
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetStorageCapacityResult extends Result
{
    /**
     * Parse data from response
     * 
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->StorageCapacity)) {
            return intval($xml->StorageCapacity);
        } else {
            throw new OssException("xml format exception");
        }
    }
}