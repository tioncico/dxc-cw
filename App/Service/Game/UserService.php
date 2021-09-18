<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Service\BaseService;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class UserService extends BaseService
{
    use Singleton;

    public function userAddExp($userId, $expNum): UserBaseAttributeModel
    {
        $userBaseAttributeInfo = BaseModel::transaction(function () use ($userId, $expNum) {
            $userBaseAttributeInfo = UserBaseAttributeModel::create()->lockForUpdate()->getInfo($userId);
            $userBaseAttributeInfo->update(['exp' => QueryBuilder::inc($expNum)]);
            $this->levelUp($userBaseAttributeInfo);
            $this->countUserBaseAttribute($userBaseAttributeInfo);
            $this->countUserAttribute($userBaseAttributeInfo->userId);
            return $userBaseAttributeInfo;
        });
        return $userBaseAttributeInfo;
    }

    protected function levelUp(UserBaseAttributeModel $userBaseAttributeInfo)
    {
        //获取等级配置
        $levelConfig = UserLevelConfigModel::create()->get($userBaseAttributeInfo->level);
        $levelUpConfig = UserLevelConfigModel::create()->get($userBaseAttributeInfo->level + 1);
        if (empty($levelUpConfig)) {
            return false;
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
        if ($userBaseAttributeInfo->exp >= $levelUpConfig->exp) {
            $this->levelUp($userBaseAttributeInfo);
        }
    }

    public function countUserBaseAttribute(UserBaseAttributeModel $userBaseAttributeInfo)
    {
        //血量公式计算=用户等级*100+用户耐力*100
        $hp = $userBaseAttributeInfo->level * 100 + $userBaseAttributeInfo->endurance * 100;
        //蓝量计算公式= 100+((用户等级-1)*10+用户智力*10);
        $mp = 100 + (($userBaseAttributeInfo->level - 1) * 10 + $userBaseAttributeInfo->intellect * 10);
        //攻击力计算=1+(用户等级*5+用户力量*10)
        $attack = 1 + ($userBaseAttributeInfo->level * 5 + $userBaseAttributeInfo->strength * 10);
        //防御力计算=0+((用户等级-1)*2+用户耐力*10)
        $defense = 0 + (($userBaseAttributeInfo->level - 1) * 2 + $userBaseAttributeInfo->endurance * 10);
        $userBaseAttributeInfo->hp = $hp;
        $userBaseAttributeInfo->mp = $mp;
        $userBaseAttributeInfo->attack = $attack;
        $userBaseAttributeInfo->defense = $defense;
        $userBaseAttributeInfo->update();
        return $userBaseAttributeInfo;
    }

    public function countUserAttribute($userId)
    {
        //获取用户基础信息
        $userBaseAttributeInfo = UserBaseAttributeModel::create()->getInfo($userId);
        $userBaseAttributeBean = new Attribute($userBaseAttributeInfo->toArray());
        $userAttributeBean = clone $userBaseAttributeBean;
        //获取用户穿戴装备信息
        $userEquipmentBackpackList = UserEquipmentBackpackModel::create()->with(['strengthenInfo', 'equipmentAttributeEntryList'])->where('userId', $userId)->where('isUse', 1)->all();

        /**
         * @var $userEquipment UserEquipmentBackpackModel
         */
        foreach ($userEquipmentBackpackList as $userEquipment) {
            //部分属性相加
            $userAttributeBean->setHp($userAttributeBean->getHp() + $userEquipment->hp);
            $userAttributeBean->setMp($userAttributeBean->getMp() + $userEquipment->mp);
            $userAttributeBean->setAttack($userAttributeBean->getAttack() + $userEquipment->attack);
            $userAttributeBean->setDefense($userAttributeBean->getDefense() + $userEquipment->defense);
            $userAttributeBean->setEndurance($userAttributeBean->getEndurance() + $userEquipment->endurance);
            $userAttributeBean->setIntellect($userAttributeBean->getIntellect() + $userEquipment->intellect);
            $userAttributeBean->setStrength($userAttributeBean->getStrength() + $userEquipment->strength);
            $userAttributeBean->setCriticalRate($userAttributeBean->getCriticalRate() + $userEquipment->criticalRate);
            $userAttributeBean->setCriticalStrikeDamage($userAttributeBean->getCriticalStrikeDamage() + $userEquipment->criticalStrikeDamage);
            $userAttributeBean->setHitRate($userAttributeBean->getHitRate() + $userEquipment->hitRate);
            $userAttributeBean->setDodgeRate($userAttributeBean->getDodgeRate() + $userEquipment->dodgeRate);
            $userAttributeBean->setPenetrate($userAttributeBean->getPenetrate() + $userEquipment->penetrate);
            $userAttributeBean->setJin($userAttributeBean->getJin() + $userEquipment->jin);
            $userAttributeBean->setMu($userAttributeBean->getMu() + $userEquipment->mu);
            $userAttributeBean->setTu($userAttributeBean->getTu() + $userEquipment->tu);
            $userAttributeBean->setSui($userAttributeBean->getSui() + $userEquipment->sui);
            $userAttributeBean->setHuo($userAttributeBean->getHuo() + $userEquipment->huo);
            $userAttributeBean->setLight($userAttributeBean->getLight() + $userEquipment->light);
            $userAttributeBean->setDark($userAttributeBean->getDark() + $userEquipment->dark);
            $userAttributeBean->setLuck($userAttributeBean->getLuck() + $userEquipment->luck);
            $userAttributeBean->setAttackSpeed($userAttributeBean->getAttackSpeed() + $userEquipment->attackSpeed);
            //元素属性覆盖
            if (!empty($userEquipment->attackElement)) {
                $userAttributeBean->setAttackElement($userEquipment->attackElement);
            }
            //强化数据
            if (isset($userEquipment->strengthenInfo)) {
                $strengthenInfo = $userEquipment->strengthenInfo;
                $userAttributeBean->incHp($strengthenInfo->hp);
                $userAttributeBean->incDefense($strengthenInfo->defense);
                $userAttributeBean->incAttack($strengthenInfo->attack);
            }
            //随机属性只在进图的时候加
        }

        UserAttributeModel::create()->where('userId', $userBaseAttributeInfo->userId)->update($userAttributeBean->toArray());
    }

}
