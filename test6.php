<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */

use App\Actor\Data\Map;
use App\Actor\Data\User;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\WebSocket\MsgPushEvent;

include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

go(function () {
    $level = 1;
    for ($i=1;$i<=5;$i++){
        $exp = $i*100;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }


    \Swoole\Timer::clearAll();
});
