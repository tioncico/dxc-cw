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
use App\Model\Game\ShopGoodsModel;
use App\Model\Game\SkillModel;
use App\Model\Game\Task\GameTaskMasterModel;
use App\Model\Game\Task\GameTaskModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\GameActor;
use EasySwoole\Component\Context\ContextManager;

Co::set(['hook_flags' => SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {

    $data = [
        'name'=>'治疗光环',
        'level'=>1,
        'entryCode'=>'0006',
        'triggerType'=>0,
        'triggerRate'=>100,
        'rarityLevel'=>3,
        'maxLevel'=>10,
        'coolingTime'=>'10',
        'manaCost'=>'10',
        'description'=>'为自己施加一个治疗光环,每秒回复生命值',
        'effectParam'=>null,
    ];
    $model = new SkillModel($data);
    $model->save();


    \Swoole\Timer::clearAll();
});
