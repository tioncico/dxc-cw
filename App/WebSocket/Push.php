<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/1 0001
 * Time: 17:30
 */

namespace App\WebSocket;


use App\Service\Wedding\WeddingRedisHashService;
use App\WebSocket\Cache\UserFdMap;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class Push implements TaskInterface
{
    protected $command;
    protected $userId;

    function __construct($userId, Command $command)
    {
        $this->userId = $userId;
        $this->command = $command;
    }

    function run(int $taskId, int $workerIndex)
    {
        $fdList = UserFdMap::getInstance()->getUserFdList($this->userId);
        if (empty($fdList)){
            return true;
        }
        foreach($fdList as $fd => $item){
            try{
                $fdInfo = ServerManager::getInstance()->getSwooleServer()->getClientInfo($fd);
                if ($fdInfo['websocket_status']==3){
                    ServerManager::getInstance()->getSwooleServer()->push($fd, $this->encode($this->command->toArray(null, $this->command::FILTER_NOT_NULL)));
                }else{

                }
            }catch (\Throwable $throwable){
                Trigger::getInstance()->throwable($throwable);
            }
        }
    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
//        var_dump($throwable);
    }

    /**
     * 数据序列化
     * encode
     * @param $msg
     * @return string|null
     * @author Tioncico
     * Time: 16:48
     */
    public function encode($msg): ?string
    {
        return json_encode($msg, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

}
