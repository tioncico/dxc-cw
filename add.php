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
use App\Model\Game\PetModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Component\Context\ContextManager;

Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {

    $data = [
        'name'=>"青龙",
        'type'=>1,
        'description'=>"青龙",
        'level'=>1,
        'hp'=>100,
        'mp'=>100,
        'attack'=>0,
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
        'dodgeRate'=>0,
        'penetrate'=>0,
        'attackSpeed'=>0,
        'userElement'=>1,
        'attackElement'=>0,
        'jin'=>0,
        'mu'=>0,
        'tu'=>0,
        'sui'=>0,
        'huo'=>0,
        'light'=>0,
        'dark'=>0,
    ];
    $name = [
        '小山精'=>3,
        '德蒙之蚯'=>3,
        '大力蚁'=>3,
        '穿山鼠'=>3,
        '蓝德山神'=>3,
        '鲤鱼王'=>4,
        '墨翠乌贼'=>4,
        '海神鲸'=>4,
        '鸭嘴小兽'=>4,
        '潜影海豹'=>4,
        '玄武'=>4,
        '小火灵'=>5,
        '赤焰鴖'=>5,
        '烈焰烛龙'=>5,
        '火山蝾螈'=>5,
        '朱雀'=>5,
        '闪萤'=>6,
        '光之子'=>6,
        '圣光羊'=>6,
        '闪电豹'=>6,
        '麒麟'=>6,
        '地狱犬'=>7,
        '幽冥精灵'=>7,
        '暗影马'=>7,
        '堕落天使'=>7,
        '魔麒麟'=>7,

    ];
    foreach ($name as $key=>$value){
        $data['name']=$key;
        $data['description']=$key;
        $data['type']=$value;
        $data['userElement']=$value;
        $model = new PetModel($data);
        $model->save();
    }

    \Swoole\Timer::clearAll();
});
