<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class BodyResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class BodyResult extends Result
{
    /**
     * @return string
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse->getBody()) ? "" : $this->rawResponse->getBody();
    }
}