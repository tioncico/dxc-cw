<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\GetLiveChannelHistory;

class GetLiveChannelHistoryResult extends Result
{
    /**
     * @return
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $channelList = new GetLiveChannelHistory();
        $channelList->parseFromXml($content);
        return $channelList;
    }
}
