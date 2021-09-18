<?php


namespace App\Service;


use App\Model\Game\GoodsModel;
use App\Model\Game\UserEquipmentBackpackModel;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Component\Singleton;

class GoodsChangeResponse
{
    const GOODS_KEY = 'changeGoodsKey';
    const EQUIPMENT_KEY = 'changeEquipmentKey';
    use Singleton;

    public function addGoods(GoodsModel $goodsModel, $num)
    {
        $data = ContextManager::getInstance()->get(self::GOODS_KEY);
        if (isset($data[$goodsModel->code])) {
            $data[$goodsModel->code]['num'] += $num;
        } else {
            $data[$goodsModel->code]['goodsInfo'] = $goodsModel->toArray();
            $data[$goodsModel->code]['num'] = $num;
        }
        ContextManager::getInstance()->set(self::GOODS_KEY, $data);
    }

    public function addEquipment(UserEquipmentBackpackModel $userEquipmentBackpackModel, $num)
    {
        $data = ContextManager::getInstance()->get(self::EQUIPMENT_KEY);
        if (isset($data[$userEquipmentBackpackModel->backpackId])) {
            $data[$userEquipmentBackpackModel->backpackId]['num'] += $num;
        } else {
            $data[$userEquipmentBackpackModel->backpackId]['equipmentInfo'] = $userEquipmentBackpackModel->toArray();
            $data[$userEquipmentBackpackModel->backpackId]['num'] = $num;
        }
        ContextManager::getInstance()->set(self::EQUIPMENT_KEY, $data);
    }

    public function getEquipment()
    {
        return ContextManager::getInstance()->get(self::EQUIPMENT_KEY);
    }

    public function getGoods()
    {
        return ContextManager::getInstance()->get(self::GOODS_KEY);
    }

}
