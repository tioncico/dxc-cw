<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */

use App\Actor\Data\Map;
use App\Actor\Data\User;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\WebSocket\MsgPushEvent;

include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

go(function () {

    $user = new User(1);
    $map = new Map(1);

    $x = $param['x'] ?? 0;
    $y = $param['y'] ?? 0;
    $monster = \App\Model\Game\MapMonsterModel::create()->get();
    $fight = new Fight($user, $monster, function ($event, ...$data)use($user) {


    });
    $fight->startFight();

    \Swoole\Timer::clearAll();
});
