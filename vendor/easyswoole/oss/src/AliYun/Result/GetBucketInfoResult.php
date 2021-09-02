<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Model\BucketInfo;

/**
 * Class GetBucketResult interface returns the result class, encapsulated
 * The returned xml data is parsed
 *
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketInfoResult extends Result
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
        if (isset($xml->Bucket)) {
            $info = new BucketInfo();
            $info->parseFromXmlNode($xml->Bucket);
            return $info;
        } else {
            throw new OssException("xml format exception");
        }
    }
}
