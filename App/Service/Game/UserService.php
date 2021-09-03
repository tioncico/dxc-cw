<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserLevelConfigModel;
use App\Service\BaseService;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class UserService extends BaseService
{
    use Singleton;

    public function userAddExp($userId, $expNum):UserBaseAttributeModel
    {
        $userBaseAttributeInfo =  BaseModel::transaction(function () use ($userId, $expNum) {
            $userBaseAttributeInfo = UserBaseAttributeModel::create()->lockForUpdate()->get($userId);
            $userBaseAttributeInfo->update(['exp' => QueryBuilder::inc($expNum)]);
            $this->levelUp($userBaseAttributeInfo);
            $this->countUserBaseAttribute($userBaseAttributeInfo);
            $this->countUserAttribute($userBaseAttributeInfo);
            return $userBaseAttributeInfo;
        });
        return $userBaseAttributeInfo;
    }

    protected function levelUp(UserBaseAttributeModel $userBaseAttributeInfo)
    {
        //获取等级配置
        $levelConfig = UserLevelConfigModel::create()->get($userBaseAttributeInfo->level);
        $levelUpConfig = UserLevelConfigModel::create()->get($userBaseAttributeInfo->level+1);
        if (empty($levelUpConfig)){
            return;
        }
        if ($userBaseAttributeInfo->exp >= $levelConfig->exp) {
            $userBaseAttributeInfo->level += 1;
            $userBaseAttributeInfo->exp -= $levelConfig->exp;
            //升级属性
            $userBaseAttributeInfo->endurance += $userBaseAttributeInfo->enduranceQualification;
            $userBaseAttributeInfo->intellect += $userBaseAttributeInfo->intellectQualification;
            $userBaseAttributeInfo->strength += $userBaseAttributeInfo->strengthQualification;
            $userBaseAttributeInfo->update();
        }
        if ($userBaseAttributeInfo->exp>=$levelUpConfig->exp){
            $this->levelUp($userBaseAttributeInfo);
        }
    }

    protected function countUserBaseAttribute(UserBaseAttributeModel $userBaseAttributeInfo)
    {
        //血量公式计算=用户等级*100+用户耐力*100
        $hp = $userBaseAttributeInfo->level * 100 + $userBaseAttributeInfo->endurance * 100;
        //蓝量计算公式= 100+(用户等级*10+用户智力*10);
        $mp = 100 + ($userBaseAttributeInfo->level * 10 + $userBaseAttributeInfo->intellect * 10);
        //攻击力计算=1+(用户等级*5+用户力量*10)
        $attack = 1 + ($userBaseAttributeInfo->level * 5 + $userBaseAttributeInfo->strength * 10);
        //防御力计算=0+(用户等级*2+用户耐力*10)
        $defense = 0 + ($userBaseAttributeInfo->level * 2 + $userBaseAttributeInfo->endurance * 10);
        $userBaseAttributeInfo->hp = $hp;
        $userBaseAttributeInfo->mp = $mp;
        $userBaseAttributeInfo->attack = $attack;
        $userBaseAttributeInfo->defense = $defense;
        $userBaseAttributeInfo->update();
        return $userBaseAttributeInfo;
    }

    protected function countUserAttribute(UserBaseAttributeModel $userBaseAttributeInfo)
    {
        UserAttributeModel::create()->where('userId', $userBaseAttributeInfo->userId)->update($userBaseAttributeInfo->toArray());
    }

}
