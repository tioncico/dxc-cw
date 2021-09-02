<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class PutSetDeleteResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class PutSetDeleteResult extends Result
{
    /**
     * @return array()
     */
    protected function parseDataFromResponse()
    {
        $body = array('body' => $this->rawResponse->getBody());
        return array_merge($this->rawResponse->getHeaders(), $body,$this->rawResponse->toArray());
    }
}
