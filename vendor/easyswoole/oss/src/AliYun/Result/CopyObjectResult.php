<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class CopyObjectResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class CopyObjectResult extends Result
{
    /**
     * @return array()
     */
    protected function parseDataFromResponse()
    {
        $body = $this->rawResponse->getBody();
        $xml = simplexml_load_string($body);
        $result = array();

        if (isset($xml->LastModified)) {
            $result[] = $xml->LastModified;
        }
        if (isset($xml->ETag)) {
            $result[] = $xml->ETag;
        }

        return array_merge($result, $this->rawResponse->getHeaders());
    }
}
