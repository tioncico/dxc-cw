<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use App\Model\Game\GoodsEquipmentAttributeEntryModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MonsterModel;
use App\Model\Game\PetModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Component\Context\ContextManager;

Co::set(['hook_flags' => SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {

    $data = [
        'name'=>"体力药剂",
        'code'=>'prop0014',
        'baseCode'=>0,
        'type'=>3,
        'description'=>"使用后将恢复50点体力",
        'gold'=>0,
        'isSale'=>0,
        'level'=>1,
        'rarityLevel'=>5,
        'extraData'=>50,
    ];
    $model = new GoodsModel($data);
    $model->save();

    \Swoole\Timer::clearAll();
});
