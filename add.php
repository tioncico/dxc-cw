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
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {
//    $data = [
//        'name'=>"新手之披",
//        'code'=>'eq_0006',
//        'type'=>7,
//        'description'=>"新手装备",
//        'gold'=>0,
//        'isSale'=>1,
//        'level'=>1,
//        'rarityLevel'=>1,
//        'extraData'=>null,
//    ];
//    $model = new GoodsModel($data);
//    $model->save();

    $data = [
        'goodsCode'=>'eq_0006',
        'equipmentType'=>1,
        'suitCode'=>null,
        'rarityLevel'=>1,
        'level'=>1,
        'hp'=>0,
        'mp'=>10,
        'attack'=>10,
        'defense'=>0,
        'endurance'=>0,
        'intellect'=>0,
        'strength'=>0,
        'enduranceQualification'=>0,
        'intellectQualification'=>0,
        'strengthQualification'=>0,
        'criticalRate'=>0,
        'criticalStrikeDamage'=>0,
        'hitRate'=>0,
        'penetrate'=>0,
        'attackSpeed'=>0,
        'userElement'=>0,
        'attackElement'=>0,
        'jin'=>0,
        'mu'=>0,
        'tu'=>0,
        'sui'=>0,
        'huo'=>0,
        'light'=>0,
        'dark'=>0,
        'luck'=>0,
    ];

    $model = new GoodsEquipmentModel($data);
    $model->save();


    \Swoole\Timer::clearAll();
});
