<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/3/25 0025
 * Time: 14:59
 */

namespace App\WebSocket;

use App\Actor\Cache\UserRelationMap;
use App\Service\User\UserService;
use App\Service\Wedding\WeddingRedisHashService;
use App\WebSocket\Cache\UserFdMap;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\Socket\Bean\Response;
use EasySwoole\Socket\Config as SocketConfig;
use EasySwoole\Socket\Dispatcher;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class Event
{
    static function websocketInit(EventRegister $register)
    {
        /**
         * **************** websocket控制器 **********************
         */
        // 创建一个 Dispatcher 配置
        $conf = new \EasySwoole\Socket\Config();
        // 设置 Dispatcher 为 WebSocket 模式
        $conf->setType(\EasySwoole\Socket\Config::WEB_SOCKET);
        // 设置解析器对象
        $conf->setParser(new WebSocketParser());
        $conf->setOnExceptionHandler(function (Server $server, \Throwable $throwable, string $raw, $client, Response $response){
            $response->setMessage(json_encode([
                'action' => null,
                'code'   => 500,
                'msg'    => $throwable->getMessage(),
                'data'   => null
            ]));
        });
        // 创建 Dispatcher 对象 并注入 config 对象
        $dispatch = new Dispatcher($conf);
        // 给server 注册相关事件 在 WebSocket 模式下  on message 事件必须注册 并且交给 Dispatcher 对象处理
        $register->set(EventRegister::onMessage, function (\swoole_websocket_server $server, \swoole_websocket_frame $frame) use ($dispatch) {
            if ($frame->data=='ping'){
                $server->push($frame->fd,"pong");
                return;
            }
            $dispatch->dispatch($server, $frame->data, $frame);
        });

        $register->set($register::onOpen, function (Server $server, \Swoole\Http\Request $request) {
            self::onOpen($server, $request);
        });

        $register->set($register::onClose, function (Server $server, int $fd, int $reactorId) {
            self::onClose($server, $fd, $reactorId);
        });
    }

    static function onOpen(Server $server, \Swoole\Http\Request $request)
    {
        $userId = $request->get['userId'] ?? null;
        if (!empty($userId)) {
            //绑定userId->fd
            UserFdMap::getInstance()->bind($request->fd, $userId);
        } else {
            self::pushSessionError($request->fd);
            ServerManager::getInstance()->getSwooleServer()->close($request->fd);
        }
    }

    static function onClose(Server $server, int $fd, int $reactorId)
    {
        $clientInfo = $server->getClientInfo($fd);
        //只有握手成功才处理关闭事件
        if (!empty($clientInfo['websocket_status']) and $clientInfo['websocket_status'] == 3) {
            UserFdMap::getInstance()->fdClose($fd);
        } else {
            return;
        }
    }

    static function pushSessionError($fd)
    {
        $command = new Command([
            'op'   => Command::SERVER_SESSION_ERROR,
            'msg'  => '登陆状态失效',
            'args' => [],
        ]);
        ServerManager::getInstance()->getSwooleServer()->push($fd, json_encode($command->toArray()));
    }
}
