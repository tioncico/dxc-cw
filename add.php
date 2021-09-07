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
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MonsterModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Component\Context\ContextManager;

Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {

    $param = ContextManager::getInstance()->get('param');
    $data = [
        'name'=>"一号深处",
        'description'=>"一号深处",
        'recommendedLevel'=>15,
        'isInstanceZone'=>0,
        'exp'=>2000,
        'gold'=>2000,
        'material'=>10,
        'equipment'=>10,
        'pet'=>10,
        'prop'=>10,
        'order'=>1,
    ];
    $model = new MapModel($data);
    $model->save();
//
//    $data = [
//        'name'=>"洞穴主导者-埃文-洛克",
//        'type'=>3,
//        'description'=>"洞穴主导者-埃文-洛克",
//        'level'=>20,
//        'hp'=>50000,
//        'mp'=>0,
//        'attack'=>1000,
//        'defense'=>300,
//        'endurance'=>0,
//        'intellect'=>0,
//        'strength'=>0,
//        'enduranceQualification'=>0,
//        'intellectQualification'=>0,
//        'strengthQualification'=>0,
//        'criticalRate'=>30,
//        'criticalStrikeDamage'=>200,
//        'hitRate'=>100,
//        'dodgeRate'=>0,
//        'penetrate'=>0,
//        'attackSpeed'=>1,
//        'userElement'=>7,
//        'attackElement'=>0,
//        'jin'=>0,
//        'mu'=>0,
//        'tu'=>0,
//        'sui'=>0,
//        'huo'=>0,
//        'light'=>0,
//        'dark'=>50,
//    ];
//    $model = new MonsterModel($data);
//    $model->save();

    \Swoole\Timer::clearAll();
});
