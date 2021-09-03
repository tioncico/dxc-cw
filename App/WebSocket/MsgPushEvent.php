<?php


namespace App\WebSocket;


use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Task\TaskManager;

class MsgPushEvent
{
    use Singleton;

    function msgPush($userId, $action, $code, $msg = '', $data = [])
    {
        $command = new Command();
        $command->setAction($action);
        $command->setCode($code);
        $command->setMsg($msg);
        $command->setData($data);
        TaskManager::getInstance()->async(new Push($userId, $command));
    }
}
