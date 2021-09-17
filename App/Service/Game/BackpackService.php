<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Service\BaseService;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class BackpackService extends BaseService
{
    use Singleton;

    public function addGold($userId, int $goldNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($userId);
        $userGoldInfo->update(['num' => QueryBuilder::inc($goldNum)]);
        return $userGoldInfo;
    }

    public function decGold($userId, int $goldNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($userId);
        $userGoldInfo->update(['num' => QueryBuilder::dec($goldNum)]);
        return $userGoldInfo;
    }

    public function addMoney($userId, int $moneyNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($userId);
        $userMoneyInfo->update(['num' => QueryBuilder::inc($moneyNum)]);
        return $userMoneyInfo;
    }

    public function decMoney($userId, int $moneyNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($userId);
        $userMoneyInfo->update(['num' => QueryBuilder::dec($moneyNum)]);
        return $userMoneyInfo;
    }

    public function addGoods($userId, GoodsModel $goodsModel, $num)
    {
        //装备无法叠加
        if ($goodsModel->type == 7) {
            $backpackInfo =   EquipmentService::getInstance()->addUserEquipment($userId,$goodsModel);
        } elseif ($goodsModel->type == 1) {
            $backpackInfo = $this->addGold($userId, $num);
        } elseif ($goodsModel->type == 2) {
            $backpackInfo = $this->addGold($userId, $num);
        } else {
            $backpackInfo = UserBackpackModel::create()->getInfoByCode($userId, $goodsModel->code);
            if (empty($backpackInfo)) {
                $backpackInfo = UserBackpackModel::create()->addData($userId, $goodsModel, $num);
            } else {
                $backpackInfo->update(['num' => QueryBuilder::inc($num)]);
            }
        }

        return $backpackInfo;
    }

    public function decGoods($userId, GoodsModel $goodsModel, $num)
    {
        if ($goodsModel->type == 7) {
//            $backpackInfo =   EquipmentService::getInstance()->addUserEquipment($userId,$goodsModel);
        } elseif ($goodsModel->type == 1) {
            $backpackInfo = $this->decGold($userId, $num);
        } elseif ($goodsModel->type == 2) {
            $backpackInfo = $this->decMoney($userId, $num);
        } else {
            $backpackInfo = UserBackpackModel::create()->getInfoByCode($userId, $goodsModel->code);
            if (empty($backpackInfo)) {
                $backpackInfo = UserBackpackModel::create()->addData($userId, $goodsModel, $num);
            } else {
                $backpackInfo->update(['num' => QueryBuilder::dec($num)]);
            }
        }
        return $backpackInfo;
    }

    public function addUserEquipmentInfo($userId, UserBackpackModel $backpackModel, GoodsEquipmentModel $equipmentModel)
    {
        //所有属性根据数值,0.7-1.7倍波动
        $data = [
            'backpackId'             => $backpackModel->backpackId,
            'userId'                 => $userId,
            'goodsCode'              => $backpackModel->goodsCode,
            'equipmentType'          => $equipmentModel->equipmentType,
            'suitCode'               => $equipmentModel->suitCode,
            'rarityLevel'            => $equipmentModel->rarityLevel,
            'level'                  => $equipmentModel->level,
            'isUse'                  => 0,
            'hp'                     => mt_rand(intval($equipmentModel->hp * 0.7), intval($equipmentModel->hp * 1.5)),
            'mp'                     => mt_rand(intval($equipmentModel->mp * 0.7), intval($equipmentModel->mp * 1.5)),
            'attack'                 => mt_rand(intval($equipmentModel->attack * 0.7), intval($equipmentModel->attack * 1.5)),
            'defense'                => mt_rand(intval($equipmentModel->defense * 0.7), intval($equipmentModel->defense * 1.5)),
            'endurance'              => mt_rand(intval($equipmentModel->endurance * 0.7), intval($equipmentModel->endurance * 1.5)),
            'intellect'              => mt_rand(intval($equipmentModel->intellect * 0.7), intval($equipmentModel->intellect * 1.5)),
            'strength'               => mt_rand(intval($equipmentModel->strength * 0.7), intval($equipmentModel->strength * 1.5)),
            'enduranceQualification' => $equipmentModel->enduranceQualification,
            'intellectQualification' => $equipmentModel->intellectQualification,
            'strengthQualification'  => $equipmentModel->strengthQualification,
            'criticalRate'           => $equipmentModel->criticalRate,
            'criticalStrikeDamage'   => $equipmentModel->criticalStrikeDamage,
            'hitRate'                => $equipmentModel->hitRate,
            'dodgeRate'              => $equipmentModel->dodgeRate,
            'penetrate'              => $equipmentModel->penetrate,
            'attackSpeed'            => $equipmentModel->attackSpeed,
            'userElement'            => $equipmentModel->userElement,
            'attackElement'          => $equipmentModel->attackElement,
            'jin'                    => $equipmentModel->jin,
            'mu'                     => $equipmentModel->mu,
            'tu'                     => $equipmentModel->tu,
            'sui'                    => $equipmentModel->sui,
            'huo'                    => $equipmentModel->huo,
            'light'                  => $equipmentModel->light,
            'dark'                   => $equipmentModel->dark,
            'luck'                   => $equipmentModel->luck,
        ];

        $model = new UserEquipmentBackpackModel($data);
        $model->save();
        return $model;
    }

}
