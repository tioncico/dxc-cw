<?php


namespace App\Utility\Cache;


use App\Model\Game\SkillModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserPetModel;
use App\Model\Game\UserSkillModel;
use App\Service\Game\EquipmentService;
use App\Service\Game\PetService;
use App\Service\Game\SkillService;
use App\Utility\RedisClient;
use EasySwoole\Component\Singleton;

class UserCache
{
    use Singleton;


    /**@var UserBaseAttributeModel */
    protected $userBaseAttribute;//用户基础信息

    /**@var UserAttributeModel */
    protected $userAttribute;//用户属性

    /**@var UserSkillModel[] */
    protected $userSkillList;//用户当前携带技能 技能code键值对

    /**@var UserPetModel */
    protected $userPetList; //用户当前宠物列表 宠物id键值对

    /**@var UserEquipmentBackpackModel */
    protected $userEquipmentList;//用户装备列表 装备部位键值对

    public function getUserBaseAttribute($userId): UserBaseAttributeModel
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $data = $redisClient->get($this->getKey("baseAttribute", $userId));
            if (empty($data)) {
                $data = UserBaseAttributeModel::create()->getInfo($userId);
                $this->setUserBaseAttribute($userId, $data);
            }
            return $data;
        });
    }

    public function getUserAttribute($userId): UserAttributeModel
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $data = $redisClient->get($this->getKey("attribute", $userId));
            if (empty($data)) {
                $data = UserAttributeModel::create()->getInfo($userId);
                $this->setUserAttribute($userId, $data);
            }
            return $data;
        });
    }

    /**
     * getUserSkillList
     * @param $userId
     * @return UserSkillModel[]
     * @throws \Throwable
     * @author tioncico
     * Time: 2:19 下午
     */
    public function getUserSkillList($userId)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $data = $redisClient->get($this->getKey("skillList", $userId));
            if (empty($data)) {
                $data = SkillService::getInstance()->getUserSkillList($userId);
                $this->setUserSkillList($userId, $data);
            }
            return $data;
        });
    }

    public function getUserPetList($userId)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $data = $redisClient->get($this->getKey("petList", $userId));
            if (empty($data)) {
                $data = PetService::getInstance()->getUserPetList($userId);
                $this->setUserPetList($userId, $data);
            }
            return $data;
        });
    }

    public function getUserEquipmentList($userId)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $data = $redisClient->get($this->getKey("equipmentList", $userId));
            if (empty($data)) {
                $data = EquipmentService::getInstance()->getUserEquipmentList($userId);
                $this->setUserPetList($userId, $data);
            }
            return $data;
        });
    }

    public function setUserBaseAttribute($userId, $data)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $data) {
            return $redisClient->set($this->getKey("baseAttribute", $userId), $data, 60 * 30);
        });
    }

    public function setUserAttribute($userId, $data)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $data) {
            return $redisClient->set($this->getKey("attribute", $userId), $data, 60 * 30);
        });
    }

    public function setUserSkillList($userId, $data)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $data) {
            return $redisClient->set($this->getKey("skillList", $userId), $data, 60 * 30);
        });
    }

    public function setUserPetList($userId, $data)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $data) {
            return $redisClient->set($this->getKey("petList", $userId), $data, 60 * 30);
        });
    }

    public function setUserEquipmentList($userId, $data)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $data) {
            return $redisClient->set($this->getKey("equipmentList", $userId), $data, 60 * 30);
        });
    }

    protected function getKey($property, $userId)
    {
        return "user_{$userId}_$property";
    }

}
