<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class HeaderResult
 * @package EasySwoole\Oss\AliYun\Result
 * @link https://docs.aliyun.com/?spm=5176.383663.13.7.HgUIqL#/pub/oss/api-reference/object&GetObjectMeta
 */
class HeaderResult extends Result
{
    /**
     * 把返回的ResponseCore中的header作为返回数据
     *
     * @return array
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse) ? array() : $this->rawResponse->toArray();
    }

}