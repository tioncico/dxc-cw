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
//    $userInfo = \App\Service\Game\UserService::getInstance()->userAddExp(1,100);
//    var_dump($userInfo->toArray());

    for ($i=8;$i<=100;$i++){
        \App\Model\Game\UserLevelConfigModel::create([
            'level'=>$i,
            'exp'=>$i*100
        ])->save();
    }
    \Swoole\Timer::clearAll();
});
