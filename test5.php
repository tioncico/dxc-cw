<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

go(function () {
    $user = \App\Model\Game\UserAttributeModel::create()->getInfo(1);
    $user->criticalRate=90;
    var_dump($user->toArray());
    $monster = \App\Model\Game\MapMonsterModel::create()->get();
    var_dump($monster->toArray());
    $fight = new \App\Actor\Fight\Fight($user, [],$monster );
    $fight->startFight(function (){

    });

    \Swoole\Timer::clearAll();
});
