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
    $userInfo = \App\Service\Game\UserService::getInstance()->userAddExp(1,100);
    var_dump($userInfo->toArray());

    \Swoole\Timer::clearAll();
});
