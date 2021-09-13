<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Service\BaseService;

class EquipmentService extends BaseService
{
    public function addUserEquipment($userId, GoodsModel $goodsInfo, GoodsEquipmentModel $equipmentInfo)
    {
        BaseModel::transaction(function () use ($userId, $goodsInfo, $equipmentInfo) {
            //新增装备信息到背包
            $backpackInfo = BackpackService::getInstance()->addGoods($userId, $goodsInfo, 1);
            $data = [
                'backpackId'             => $backpackInfo->userId,
                'userId'                 => $userId,
                'isUse'                  => 0,
                'strengthenLevel'        => $equipmentInfo->strengthenLevel,
                'goodsCode'              => $equipmentInfo->goodsCode,
                'goodsName'              => $equipmentInfo->goodsName,
                'equipmentType'          => $equipmentInfo->equipmentType,
                'suitCode'               => $equipmentInfo->suitCode,
                'rarityLevel'            => $equipmentInfo->rarityLevel,
                'level'                  => $equipmentInfo->level,
                'hp'                     => $equipmentInfo->hp,
                'mp'                     => $equipmentInfo->mp,
                'attack'                 => $equipmentInfo->attack,
                'defense'                => $equipmentInfo->defense,
                'endurance'              => $equipmentInfo->endurance,
                'intellect'              => $equipmentInfo->intellect,
                'strength'               => $equipmentInfo->strength,
                'enduranceQualification' => $equipmentInfo->enduranceQualification,
                'intellectQualification' => $equipmentInfo->intellectQualification,
                'strengthQualification'  => $equipmentInfo->strengthQualification,
                'criticalRate'           => $equipmentInfo->criticalRate,
                'criticalStrikeDamage'   => $equipmentInfo->criticalStrikeDamage,
                'hitRate'                => $equipmentInfo->hitRate,
                'dodgeRate'              => $equipmentInfo->dodgeRate,
                'penetrate'              => $equipmentInfo->penetrate,
                'attackSpeed'            => $equipmentInfo->attackSpeed,
                'userElement'            => $equipmentInfo->userElement,
                'attackElement'          => $equipmentInfo->attackElement,
                'jin'                    => $equipmentInfo->jin,
                'mu'                     => $equipmentInfo->mu,
                'tu'                     => $equipmentInfo->tu,
                'sui'                    => $equipmentInfo->sui,
                'huo'                    => $equipmentInfo->huo,
                'light'                  => $equipmentInfo->light,
                'dark'                   => $equipmentInfo->dark,
                'luck'                   => $equipmentInfo->luck,
            ];
            //插入装备信息
            $model = new UserEquipmentBackpackModel($data);
            $model->save();

        });

    }
}
