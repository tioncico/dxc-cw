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
    $beginWeek = mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y"));
    var_dump($beginWeek);
    var_dump(date('Ymd',$beginWeek));
    \Swoole\Timer::clearAll();
});
