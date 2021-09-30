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
    $fight = new \App\Actor\Fight\Fight(\App\Model\Game\UserAttributeModel::create()->getInfo(1), [], \App\Model\Game\MapMonsterModel::create()->get());
    $fight->startFight(function (){

    });

    \Swoole\Timer::clearAll();
});
