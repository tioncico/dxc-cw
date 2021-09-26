<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\LiveChannelListInfo;

class ListLiveChannelResult extends Result
{
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $channelList = new LiveChannelListInfo();
        $channelList->parseFromXml($content);
        return $channelList;
    }
}
