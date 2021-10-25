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
        $exp = $i*100*1;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=6;$i<=10;$i++){
        $exp = $i*100*2;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=11;$i<=15;$i++){
        $exp = $i*100*3;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=16;$i<=20;$i++){
        $exp = $i*100*4;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=21;$i<=25;$i++){
        $exp = $i*100*5;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=26;$i<=30;$i++){
        $exp = $i*100*10;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=31;$i<=35;$i++){
        $exp = $i*100*15;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=36;$i<=40;$i++){
        $exp = $i*100*20;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=41;$i<=45;$i++){
        $exp = $i*100*25;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=46;$i<=50;$i++){
        $exp = $i*100*30;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }
    for ($i=51;$i<=60;$i++){
        $exp = $i*100*35;
        \App\Model\Game\UserLevelConfigModel::create()->where('level',$i)->update(['exp'=>$exp]);
    }


    \Swoole\Timer::clearAll();
});
