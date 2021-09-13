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
    $arr = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
    ];
    $i=42;

    foreach ($arr as $key=>$value) {
        $data = [
            'code'               => str_pad($i, 3, "0", STR_PAD_LEFT),
            'name'               => "attack",
            'equipmentEntryType' => 3,
            'baseCode'           => '0002',
            'level'              => $key,
            'description'        => "+{$key}% 暴击率",
            'odds'               => 0,
            'param'              => json_encode([
                'attribute' => 'criticalRate',
                'num'       => $value
            ]),
        ];
        $model = new GoodsEquipmentAttributeEntryModel($data);
        $model->save();
        $i++;
    }
    \Swoole\Timer::clearAll();
});
