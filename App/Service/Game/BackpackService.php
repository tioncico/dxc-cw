<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\UserBackpackModel;
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


}
