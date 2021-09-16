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
//   $data =  \App\Service\Game\EquipmentService::getInstance()->addUserEquipmentEntry(new \App\Model\Game\UserBackpackModel(),GoodsEquipmentModel::create()->get("eq_0001"));
//   var_dump($data);

   \App\Service\Game\EquipmentService::getInstance()->addUserEquipment(1,\App\Model\Game\GoodsModel::create()->getInfoByCode('eq_0001'),GoodsEquipmentModel::create()->get("eq_0001"));


    \Swoole\Timer::clearAll();
});
