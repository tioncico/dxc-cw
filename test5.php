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
        MsgPushEvent::getInstance()->msgPush(1, $event, 200, "发送游戏数据", $data);
        if ($event=='FIGHT_START'){
            $user->getUserNowAttribute()->getSkillManager()->useSkill($user->getUserNowAttribute()->getSkillList()['0005']);
//            $user->getUserNowAttribute()->getSkillManager()->useSkill($user->getUserNowAttribute()->getSkillList()['0005']);
        }
    });
    $fight->startFight();

    \Swoole\Timer::clearAll();
});
