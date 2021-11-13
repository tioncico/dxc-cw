<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Service\BaseService;
use App\Service\GameResponse;
use App\Utility\Cache\UserCache;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Logger;
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
            $userBaseAttributeInfo->endurance = $userBaseAttributeInfo->enduranceQualification * $userBaseAttributeInfo->level;
            $userBaseAttributeInfo->intellect = $userBaseAttributeInfo->intellectQualification * $userBaseAttributeInfo->level;
            $userBaseAttributeInfo->strength = $userBaseAttributeInfo->strengthQualification * $userBaseAttributeInfo->level;
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

    public function countUserAttribute($userId): UserAttributeModel
    {
        //获取用户基础信息
        $userBaseAttributeInfo = UserCache::getInstance()->getUserBaseAttribute($userId);
        $userBaseAttributeBean = new Attribute($userBaseAttributeInfo->toArray());
        $userAttributeBean = clone $userBaseAttributeBean;
        //获取用户穿戴装备信息
        $userEquipmentBackpackList = UserCache::getInstance()->getUserEquipmentList($userId);

        /**
         * @var $userEquipment UserEquipmentBackpackModel
         */
        foreach ($userEquipmentBackpackList as $userEquipment) {
            EquipmentService::getInstance()->incUserAttribute($userAttributeBean, $userEquipment);
            //元素属性覆盖
            if (!empty($userEquipment->attackElement)) {
                $userAttributeBean->setAttackElement($userEquipment->attackElement);
            }
        }
        //获取宠物缓存数据
        $userPetList = UserCache::getInstance()->getUserPetList($userId, true);
        foreach ($userPetList as $userPet) {
            PetService::getInstance()->incUserAttribute($userAttributeBean, $userPet);
        }

        $userAttributeModel = UserCache::getInstance()->getUserAttribute($userId);
        $userAttributeModel->update($userAttributeBean->toArray());
        UserCache::getInstance()->setUserAttribute($userId, $userAttributeModel);
        GameResponse::getInstance()->setUser($userAttributeModel);
        return $userAttributeModel;
    }

    public function countFightAttribute(int $userId)
    {
        Logger::getInstance()->info("计算用户{$userId} 战斗数据");
        //获取用户基础信息
        $userBaseAttributeInfo = UserCache::getInstance()->getUserBaseAttribute($userId);
        $userBaseAttributeBean = new Attribute($userBaseAttributeInfo->toArray());
        $userAttributeBean = clone $userBaseAttributeBean;
        //获取用户穿戴装备信息
        $userEquipmentBackpackList = UserCache::getInstance()->getUserEquipmentList($userId);

        /**
         * @var $userEquipment UserEquipmentBackpackModel
         */
        foreach ($userEquipmentBackpackList as $userEquipment) {
            Logger::getInstance()->info("计算用户{$userId} 装备{$userEquipment->goodsName}数据");
            EquipmentService::getInstance()->incUserAttribute($userAttributeBean, $userEquipment);
            //元素属性覆盖
            if (!empty($userEquipment->attackElement)) {
                $userAttributeBean->setAttackElement($userEquipment->attackElement);
            }
            EquipmentService::getInstance()->incUserAttributeByEquipmentAttributeEntry($userBaseAttributeBean,$userAttributeBean,$userEquipment);
        }
        //获取宠物缓存数据
        $userPetList = UserCache::getInstance()->getUserPetList($userId, true);
        foreach ($userPetList as $userPet) {
            Logger::getInstance()->info("计算用户{$userId}宠物{$userPet->name}数据");
            PetService::getInstance()->incUserAttribute($userAttributeBean, $userPet);
        }
        return $userAttributeBean;
    }

}
