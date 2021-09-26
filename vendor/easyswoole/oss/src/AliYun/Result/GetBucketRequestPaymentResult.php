<?php

namespace EasySwoole\Oss\AliYun\Result;


use EasySwoole\Oss\AliYun\Model\RequestPaymentConfig;

/**
 * Class GetBucketRequestPaymentResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class GetBucketRequestPaymentResult extends Result
{
    /**
     *  Parse the RequestPaymentConfig object from the response
     *
     * @return RequestPaymentConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $config = new RequestPaymentConfig();
        $config->parseFromXml($content);
        return $config->getPayer();
    }
}
