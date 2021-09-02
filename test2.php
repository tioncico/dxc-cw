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
go(function () {

    $user = new Attribute();
    $user->setAttackSpeed(1);
    $user->setAttack(100);
    $monster = new Attribute();
    $monster->setAttack(8);
    $monster->setAttackSpeed(1);

    $fight = new Fight($user, $monster);
    $fight->start();
    \Swoole\Timer::clearAll();
});
