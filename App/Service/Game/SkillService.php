<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\SkillLevelUpNeedGoodsModel;
use App\Model\Game\SkillModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Model\Game\UserSkillModel;
use App\Service\BaseService;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class SkillService extends BaseService
{
    use Singleton;

    /**
     * 获取用户已学技能列表
     * getUserSkillList
     * @param $userId
     * @author tioncico
     * Time: 2:41 下午
     */
    public function getUserSkillList($userId)
    {
        //4个主动技能,还可以携带4个被动技能
        $list = UserSkillModel::create()->where('userId', $userId)->where('isUse', 1)->all();
        $userSkillList = [];
        /**
         * @var UserSkillModel $value
         */
        foreach ($list as $value) {
            $userSkillList[$value->entryCode] = $value;
        }
        return $userSkillList;
    }

    public function userStudySkill($userId, SkillModel $skillModel)
    {
        $userSkillModel = new UserSkillModel();
        $skillInfo = $userSkillModel->getUserSkillByCode($userId, $skillModel);
        Assert::assert($skillInfo->maxLevel > $skillInfo->level, "等级已升级到满级");
        $skillInfo = $skillInfo->levelUp($userId, $skillModel);
        return $skillInfo;
    }

    public function getStudyNeedGoods(int $skillId, int $level)
    {
        $goodsList = SkillLevelUpNeedGoodsModel::create()->with(['goodsInfo'], false)->where('skillId', $skillId)->where('level', $level)->all();
        return $goodsList;
    }

    public function skillLevelUp($userId, SkillModel $skillModel): UserSkillModel
    {
        //判断玩家有没有学
        $userSkillInfo = UserSkillModel::create()->getUserSkillByCode($userId, $skillModel);
        if ($userSkillInfo) {
            $level = $userSkillInfo->level + 1;
        } else {
            $level = 1;
        }
        $goodsList = $this->getStudyNeedGoods($skillModel->skillId, $level);
        return BaseModel::transaction(function () use ($userSkillInfo, $skillModel, $goodsList) {

            /**
             * @var $goods SkillLevelUpNeedGoodsModel
             */
            foreach ($goodsList as $goods) {
                $num = $goods->goodsNum;
                /**
                 * @var $goodsInfo GoodsModel
                 */
                $goodsInfo = $goods->goodsInfo;
                $userBackpackInfo = UserBackpackModel::create()->getInfoByCode($userSkillInfo->userId, $goodsInfo->code);
                Assert::assert($userBackpackInfo->num > $num, "物品 [{$goodsInfo->name}] 数量不足");
                BackpackService::getInstance()->decGoods($userSkillInfo->userId, $goodsInfo, $num);
            }
            return $this->userStudySkill($userSkillInfo->userId, $skillModel);
        });
    }

}
