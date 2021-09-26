<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class DeleteObjectsResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class DeleteObjectsResult extends Result
{
    /**
     * @return array()
     */
    protected function parseDataFromResponse()
    {
        $body = $this->rawResponse->getBody();
        $xml = simplexml_load_string($body); 
        $objects = array();

        if (isset($xml->Deleted)) {
            foreach($xml->Deleted as $deleteKey)
                $objects[] = $deleteKey->Key;
        }
        return $objects;
    }
}
