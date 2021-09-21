<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\PetModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Service\GameResponse;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;

class UseGoodsService
{
    use Singleton;

    public function useGoods(UserBackpackModel $userBackpackInfo, $num = 1)
    {
        $code = $userBackpackInfo->goodsCode;
        //获取物品baseCode
        $goodsInfo = GoodsModel::create()->getInfoByCode($code);
        $method = $goodsInfo->baseCode;
        Assert::assert(method_exists($this, $method), "该物品无法使用");
        BaseModel::transaction(function () use ($method, $userBackpackInfo, $num, $goodsInfo) {
            $userBackpackInfo = $userBackpackInfo->lockForUpdate()->get(['backpackId' => $userBackpackInfo->backpackId]);
            Assert::assert($userBackpackInfo->num >= $num, '物品数量不足,无法使用');
            $this->$method($userBackpackInfo, $goodsInfo, $num);
            //扣除道具
            BackpackService::getInstance()->decGoods($userBackpackInfo->userId, $goodsInfo, $num);
        });

    }


    /**
     * 体力药剂
     * prop001
     * @param UserBackpackModel $userBackpackInfo
     * @param GoodsModel        $goodsInfo
     * @param                   $num
     * @author tioncico
     * Time: 6:41 下午
     */
    protected function prop001(UserBackpackModel $userBackpackInfo, GoodsModel $goodsInfo, $num)
    {
        $num = intval($goodsInfo->extraData * $num);
        //获取用户基础信息
        $userBaseAttribute = UserBaseAttributeModel::create()->getInfo($userBackpackInfo->userId);
        //获取用户当前体力信息
        $userAttribute = UserAttributeModel::create()->getInfo($userBackpackInfo->userId);
        $userAttribute->physicalStrength += $num;
        if ($userAttribute->physicalStrength >= $userBaseAttribute->physicalStrength) {
            $userAttribute->physicalStrength = $userBaseAttribute->physicalStrength;
        }
        $userAttribute->update();
    }

    protected function petEgg(UserBackpackModel $userBackpackInfo, GoodsModel $goodsInfo, $num)
    {
        $petId = $goodsInfo->extraData;
        $petInfo = PetModel::create()->get($petId);
        for ($i = 0; $i < $num; $i++) {
            $userPetInfo = PetService::getInstance()->addUserPet($userBackpackInfo->userId, $petInfo);
            GameResponse::getInstance()->addPet($userPetInfo,1);
        }
    }

}
