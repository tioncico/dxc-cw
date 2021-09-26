<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\LiveChannelInfo;

class PutLiveChannelResult extends Result
{
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $channel = new LiveChannelInfo();
        $channel->parseFromXml($content);
        return $channel;
    }
}
