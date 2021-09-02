<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\GetLiveChannelInfo;

class GetLiveChannelInfoResult extends Result
{
    /**
     * @return
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->getBody();
        $channelList = new GetLiveChannelInfo();
        $channelList->parseFromXml($content);
        return $channelList;
    }
}
