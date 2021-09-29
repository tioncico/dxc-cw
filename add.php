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
        'name'=>'雷霆一击',
        'level'=>1,
        'type'=>0,
        'rarityLevel'=>1,
        'maxLevel'=>10,
        'coolingTime'=>'10',
        'manaCost'=>'20+($trigger_skillLevel*10)',
        'entryCode'=>'0002',
        'description'=>'蓄力攻击一次,造成 100+(100+[技能等级]*10)%攻击力伤害',
        'param'=>'["100+(100+{$trigger_skillLevel}*10)*{$trigger_attack}/100"]',
        'paramNum'=>1,
    ];
    $model = new SkillModel($data);
    $model->save();
    \Swoole\Timer::clearAll();
});
