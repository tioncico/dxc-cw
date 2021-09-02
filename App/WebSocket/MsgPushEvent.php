<?php


namespace App\WebSocket;


use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Task\TaskManager;

class MsgPushEvent
{
    use Singleton;

    /**
     * websocket消息推送
     * @param $commandType // 命令类型
     * @param $content // 推送内容
     * @param $userId // 用户id
     * @param $extraData // 附加信息
     */
    function msgPush($commandType, $userId, $content, $extraData=null)
    {
        $command = new Command();
        $command->setMsg(json_encode($content, JSON_UNESCAPED_UNICODE));
        $command->setOp($commandType);
        $command->setArgs($extraData);
        TaskManager::getInstance()->async(new Push($userId, $command));
    }
}
