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
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Component\Context\ContextManager;

Co::set(['hook_flags' => SWOOLE_HOOK_ALL]); // v4.4+版本使用此方法。

go(function () {

    ShopGoodsModel::create()->addData(GoodsModel::create()->getInfoByCode('material00002'),100);
    \Swoole\Timer::clearAll();
});
