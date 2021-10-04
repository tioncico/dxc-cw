<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Model\Game\UserSkillModel;
use App\Service\BaseService;
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

}
