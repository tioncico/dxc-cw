<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/11/1 0001
 * Time: 14:42
 */

namespace App\WebSocket\Controller;

use App\Actor\Cache\UserRelationMap;
use App\Actor\MapActor;
use App\Model\Game\MapModel;
use App\Model\Game\UserMapModel;
use App\Utility\Assert\Assert;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\Socket\AbstractInterface\Controller;
use EasySwoole\Socket\Bean\Response;

/**
 * Class Index
 *
 * 此类是默认的 websocket 消息解析后访问的 控制器
 *
 * @package App\WebSocket
 */
class Index extends BaseController
{
    function hello()
    {
        TaskManager::getInstance()->async(function () {
            $server = ServerManager::getInstance()->getSwooleServer();
            $fdList = $server->getClientList();
            var_dump($fdList);
        });
    }

    public function who()
    {
        $this->response()->setMessage('your fd is ' . $this->caller()->getClient()->getFd());
    }

    function delay()
    {
        $this->response()->setMessage('this is delay action');
        $client = $this->caller()->getClient();

        // 异步推送, 这里直接 use fd也是可以的
        TaskManager::getInstance()->async(function () use ($client) {
            $server = ServerManager::getInstance()->getSwooleServer();
            $i = 0;
            while ($i < 5) {
                sleep(1);
                $server->push($client->getFd(), 'push in http at ' . date('H:i:s'));
                $i++;
            }
        });
    }


    function getMapActorId()
    {
        $userId = $this->userId();
        //获取地图actorId
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        $this->push('getMapActorId', ['actorId' => $actorId]);
    }

    public function accessMap()
    {
        $userId = $this->userId();
        $param = $this->getParam();
        $mapId = (int)$param['mapId'];
        $mapInfo = UserMapModel::create()->get(['mapId' => $mapId, 'userId' => $userId]);
        Assert::assert(!!$mapInfo, '地图信息不存在或未解锁');
        //获取地图actorId
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!$actorId, '你已进入地图');
        //创建地图actor
        MapActor::client()->create(['userId' => $userId, 'mapId' => $mapId]);   // 00101000000000000000001
        //创建关联关系
        UserRelationMap::getInstance()->addUserMap($userId, $mapId);

        $this->responseMsg('accessMap', "进入地图成功");
    }
}
