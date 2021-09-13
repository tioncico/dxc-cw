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
Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {
    $ws = new \UnitTest\WebSocket();
//    $ws->intoMap();
//    sleep(1);
//    $ws->fight();
//    sleep(1);
//    $ws->useSkill();
    $ws->console();


    \Swoole\Timer::clearAll();
});
