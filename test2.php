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

go(function () {

    $user = new Attribute();
    $user->setAttackSpeed(4);
    $monster = new Attribute();
    $monster->setAttackSpeed(4);

    $fight = new \App\Service\Game\Fight\Fight($user, $monster);
    $fight->start();
    \Swoole\Timer::clearAll();
});
