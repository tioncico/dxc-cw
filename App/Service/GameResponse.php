<?php


namespace App\Service;


use App\Model\Game\GoodsModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserPetModel;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Logger;

class GameResponse
{
    const GOODS_KEY = 'changeGoodsKey';
    const EQUIPMENT_KEY = 'changeEquipmentKey';
    const PET_KEY = 'changePetKey';
    const USER_ATTRIBUTE_CHANGE_KEY = 'changeUserAttribute';
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

    public function addPet(UserPetModel $userPetModel, $num)
    {
        $data = ContextManager::getInstance()->get(self::PET_KEY);
        if (isset($data[$userPetModel->userPetId])) {
            $data[$userPetModel->userPetId]['num'] += $num;
        } else {
            $data[$userPetModel->userPetId]['petInfo'] = $userPetModel->toArray();
            $data[$userPetModel->userPetId]['num'] = $num;
        }
        ContextManager::getInstance()->set(self::PET_KEY, $data);
    }


    public function setUser(UserAttributeModel $userAttributeModel)
    {
        ContextManager::getInstance()->set(self::USER_ATTRIBUTE_CHANGE_KEY, $userAttributeModel);
    }

    public function addEquipment(UserEquipmentBackpackModel $userEquipmentBackpackModel, $num = 1)
    {
        $data = ContextManager::getInstance()->get(self::EQUIPMENT_KEY);
        if (isset($data[$userEquipmentBackpackModel->backpackId])) {
            $data[$userEquipmentBackpackModel->backpackId]['num'] += $num;
        } else {
            $goodsInfo = GoodsModel::create()->getInfoByCode($userEquipmentBackpackModel->goodsCode);
            $data[$userEquipmentBackpackModel->backpackId]['backpackId'] = $userEquipmentBackpackModel->backpackId;
            $data[$userEquipmentBackpackModel->backpackId]['userId'] = $userEquipmentBackpackModel->userId;
            $data[$userEquipmentBackpackModel->backpackId]['goodsId'] = $goodsInfo->goodsId;
            $data[$userEquipmentBackpackModel->backpackId]['goodsCode'] = $goodsInfo->code;
            $data[$userEquipmentBackpackModel->backpackId]['goodsType'] = $goodsInfo->type;
            $data[$userEquipmentBackpackModel->backpackId]['goodsInfo'] = $goodsInfo->toArray();
            $data[$userEquipmentBackpackModel->backpackId]['userEquipmentInfo'] = $userEquipmentBackpackModel->toArray();
            $data[$userEquipmentBackpackModel->backpackId]['num'] = $num;
        }
        ContextManager::getInstance()->set(self::EQUIPMENT_KEY, $data);
    }

    public function getEquipment()
    {
        $equipment = ContextManager::getInstance()->get(self::EQUIPMENT_KEY);
        if (empty($equipment)) {
            $equipment = [];
        }
        return array_values($equipment);
    }

    public function getGoods()
    {
        $goods = ContextManager::getInstance()->get(self::GOODS_KEY);
        if (empty($goods)) {
            $goods = [];
        }
        return array_values($goods);
    }

    public function getPets()
    {
        $goods = ContextManager::getInstance()->get(self::PET_KEY);
        if (empty($goods)) {
            $goods = [];
        }
        return array_values($goods);
    }

    public function getUserAttribute()
    {
        $info = ContextManager::getInstance()->get(self::USER_ATTRIBUTE_CHANGE_KEY);
        if (empty($info)) {
            $info = [];
        }
        return $info;
    }

}
