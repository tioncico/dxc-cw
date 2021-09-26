<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use App\Actor\UserActor;
use App\Model\Game\GoodsEquipmentModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Actor\Actor;

go(function () {
    // 注册Actor管理器
    $server = \EasySwoole\EasySwoole\ServerManager::getInstance()->getSwooleServer();
    Actor::getInstance()->register(MapActor::class);
    Actor::getInstance()->register(UserActor::class);
    Actor::getInstance()->setTempDir(EASYSWOOLE_TEMP_DIR)->setListenAddress('0.0.0.0')->setListenPort('9900')->attachServer($server);

    $data = UserActor::getUserBaseAttribute(1);
    var_dump($data);

    \Swoole\Timer::clearAll();
});
