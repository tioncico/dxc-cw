<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use App\Model\Game\GoodsEquipmentModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
go(function () {
    \App\Service\Game\EquipmentService::getInstance()->addUserEquipmentEntry(new \App\Model\Game\UserBackpackModel(),GoodsEquipmentModel::create()->get("eq_0001"));


    \Swoole\Timer::clearAll();
});
