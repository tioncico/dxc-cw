<?php

namespace EasySwoole\Oss\AliYun\Result;


/**
 * Class CallbackResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class CallbackResult extends PutSetDeleteResult
{
    protected function isResponseOk()
    {
        $status = $this->rawResponse->getStatusCode();
        if ((int)(intval($status) / 100) == 2 && (int)(intval($status)) !== 203) {
            return true;
        }
        return false;
    }

}
