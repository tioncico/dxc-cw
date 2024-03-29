<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\Task\GameDailyTaskModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserGoodsEquipmentAttributeEntryModel;
use App\Model\UserGoodsEquipmentStrengthenAttributeModel;
use App\Service\BaseService;
use App\Service\Game\Task\DailyTaskService;
use App\Service\GameResponse;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class BackpackService extends BaseService
{
    use Singleton;

    protected function addGold($userId, int $goldNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($userId);
        $userGoldInfo->update(['num' => QueryBuilder::inc($goldNum)]);
        return $userGoldInfo;
    }

    protected function decGold($userId, int $goldNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($userId);
        $userGoldInfo->update(['num' => QueryBuilder::dec($goldNum)]);
        return $userGoldInfo;
    }

    protected function addMoney($userId, int $moneyNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($userId);
        $userMoneyInfo->update(['num' => QueryBuilder::inc($moneyNum)]);
        return $userMoneyInfo;
    }

    protected function decMoney($userId, int $moneyNum): UserBackpackModel
    {
        //获取用户背包金币数据
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($userId);
        $userMoneyInfo->update(['num' => QueryBuilder::dec($moneyNum)]);

        if ($moneyNum >= 50) {
            //每日任务
            DailyTaskService::getInstance()->completeTask($userId, GameDailyTaskModel::create(['code' => '007'])->get());
        }

        return $userMoneyInfo;
    }

    public function addGoods($userId, GoodsModel $goodsModel, $num)
    {
        //装备无法叠加
        if ($goodsModel->type == 7) {
            for ($i = 0; $i < $num; $i++) {
                $backpackInfo = EquipmentService::getInstance()->addUserEquipment($userId, $goodsModel);
            }
        } elseif ($goodsModel->type == 1) {
            $backpackInfo = $this->addGold($userId, $num);
        } elseif ($goodsModel->type == 2) {
            $backpackInfo = $this->addMoney($userId, $num);
        } else {
            $backpackInfo = UserBackpackModel::create()->getInfoByCode($userId, $goodsModel->code);
            if (empty($backpackInfo)) {
                $backpackInfo = UserBackpackModel::create()->addData($userId, $goodsModel, $num);
            } else {
                $backpackInfo->update(['num' => QueryBuilder::inc($num)]);
            }
        }
        if ($goodsModel->type != 7) {
            GameResponse::getInstance()->addGoods($goodsModel, $num);
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
            Assert::assert($backpackInfo->num>=$num,"物品[$goodsModel->name]数量不足");
            if (empty($backpackInfo)) {
                $backpackInfo = UserBackpackModel::create()->addData($userId, $goodsModel, $num);
            } else {
                $backpackInfo->update(['num' => QueryBuilder::dec($num)]);
            }
        }
        if ($goodsModel->type != 7) {
            GameResponse::getInstance()->addGoods($goodsModel, -$num);
        }
        return $backpackInfo;
    }

    /**
     * 使用物品,只有部分道具,礼包,宠物蛋可使用
     * useGoods
     * @param                   $userId
     * @param UserBackpackModel $userBackpackModel
     * @param                   $num
     * @author tioncico
     * Time: 3:33 下午
     */
    public function useGoods($userId, UserBackpackModel $userBackpackModel, $num)
    {


    }
}
