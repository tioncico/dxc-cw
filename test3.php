<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
go(function () {
    // 管理本机的Actor则不需要声明节点
    $node = new \EasySwoole\Actor\ActorNode();
    $node->setIp('127.0.0.1');
    $node->setListenPort(9900);
    \EasySwoole\Actor\Actor::getInstance()->register(MapActor::class);

    // 启动一个Actor并得到ActorId 后续操作需要依赖ActorId
    $actorId = MapActor::client($node)->create(['userId' => 1,'mapId'=>1]);   // 00101000000000000000001
    // 给某个Actor发消息
    MapActor::client($node)->send($actorId, ['data' => 'data']);
    // 给该类型的全部Actor发消息
    MapActor::client($node)->sendAll(['data' => 'data']);
    // 退出某个Actor
    MapActor::client($node)->exit($actorId, ['arg' => 'arg']);
    // 退出全部Actor
    MapActor::client($node)->exitAll(['arg' => 'arg']);
    \Swoole\Timer::clearAll();
});
