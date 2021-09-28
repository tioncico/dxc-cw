<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use App\Actor\UserActor;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\Task\GameTaskMasterModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Actor\Actor;

go(function () {


    \Swoole\Timer::clearAll();
});
