<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\CnameConfig;

class GetCnameResult extends Result
{
    /**
     * @return CnameConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new CnameConfig();
        $config->parseFromXml($content);
        return $config;
    }
}