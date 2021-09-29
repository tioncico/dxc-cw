<?php


namespace App\WebSocket\Controller;


use App\Actor\Cache\UserRelationMap;
use App\Actor\Command;
use App\Actor\GameActor;
use App\Utility\Assert\Assert;
use App\WebSocket\Cache\UserFdMap;
use App\WebSocket\MsgPushEvent;
use EasySwoole\Socket\AbstractInterface\Controller;

class BaseController extends Controller
{
    public function userId()
    {
        return UserFdMap::getInstance()->getFdUserId($this->getFd());
    }

    public function actorSend($action, $data = [])
    {
        $actorId = UserRelationMap::getInstance()->getUserMap($this->userId());
        Assert::assert(!!$actorId, '地图信息不存在');
        $data['requestId'] = $this->getParam()['requestId'];
        GameActor::client()->send($actorId, new Command(['action' => $action, 'data' => $data]));
    }

    public function getParam()
    {
        return $this->caller()->getArgs();
    }

    public function getFd()
    {
        return $this->caller()->getClient()->getFd();
    }

    public function responseMsg($code, $msg = '', $content = null)
    {
        $this->response()->setMessage(json_encode([
            'action' => $this->caller()->getAction(),
            'code'   => $code,
            'msg'    => $msg,
            'data'   => $content
        ], JSON_UNESCAPED_UNICODE));
    }

    protected function actionNotFound(?string $actionName)
    {
        $this->response()->setMessage(json_encode([
            'action' => $this->caller()->getAction(),
            'code'   => 404,
            'msg'    => "控制器未找到",
            'data'   => null
        ], JSON_UNESCAPED_UNICODE));
    }

    protected function onException(\Throwable $throwable): void
    {
        $this->response()->setMessage(json_encode([
            'action'    => $this->caller()->getAction(),
            'code'      => 400,
            'msg'       => $throwable->getMessage(),
            'requestId' => $this->caller()->getArgs()['requestId'],
            'data'      => null
        ], JSON_UNESCAPED_UNICODE));
    }
}
