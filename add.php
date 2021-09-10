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

Co::set(['hook_flags' => SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {
    $data = [
        'name'        => '低级hp药剂',
        'code'        => 'hp0001',
        'type'        => 6,
        'description' => '',
        'gold'        => 1,
        'isSale'      => 1,
        'level'       => 1,
        'rarityLevel' => 1,
        'extraData'   => 500,
    ];
    $arr = [
        '宠物蛋·铁甲蜥' => 'gift',
        '宠物蛋·小金猴' => 'gift',
        '宠物蛋·小鸡灵' => 'gift',
        '宠物蛋·荒野雄狼' => 'gift',
        '宠物蛋·荒野雄狮' => 'gift',
        '宠物蛋·白虎' => 'gift',
        '宠物蛋·荆棘大树' => 'gift',
        '宠物蛋·嘉文喵' => 'gift',
        '宠物蛋·威镰草' => 'gift',
        '宠物蛋·小精灵' => 'gift',
        '宠物蛋·碧蟾蜍' => 'gift',
        '宠物蛋·蘑力菇' => 'gift',
        '宠物蛋·青龙' => 'gift',
        '宠物蛋·小山精' => 'gift',
        '宠物蛋·德蒙之蚯' => 'gift',
        '宠物蛋·大力蚁' => 'gift',
        '宠物蛋·穿山鼠' => 'gift',
        '宠物蛋·蓝德山神' => 'gift',
        '宠物蛋·鲤鱼王' => 'gift',
        '宠物蛋·墨翠乌贼' => 'gift',
        '宠物蛋·海神鲸' => 'gift',
        '宠物蛋·鸭嘴小兽' => 'gift',
        '宠物蛋·潜影海豹' => 'gift',
        '宠物蛋·玄武' => 'gift',
        '宠物蛋·小火灵' => 'gift',
        '宠物蛋·赤焰鴖' => 'gift',
        '宠物蛋·烈焰烛龙' => 'gift',
        '宠物蛋·火山蝾螈' => 'gift',
        '宠物蛋·朱雀' => 'gift',
        '宠物蛋·闪萤' => 'gift',
        '宠物蛋·光之子' => 'gift',
        '宠物蛋·圣光羊' => 'gift',
        '宠物蛋·闪电豹' => 'gift',
        '宠物蛋·麒麟' => 'gift',
        '宠物蛋·地狱犬' => 'gift',
        '宠物蛋·幽冥精灵' => 'gift',
        '宠物蛋·暗影马' => 'gift',
        '宠物蛋·堕落天使' => 'gift',
        '宠物蛋·魔麒麟' => 'gift',
    ];
    $i=1;
    foreach ($arr as $key => $value) {
        $data['name'] = $key;
        $data['code'] = 'pet'.str_pad($i,5,'0',STR_PAD_LEFT);
        $data['description'] = $key;
        $model = new GoodsModel($data);
        $model->save();
        $i++;
    }


    \Swoole\Timer::clearAll();
});
