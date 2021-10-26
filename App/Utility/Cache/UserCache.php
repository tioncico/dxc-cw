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

    /**
     * getUserBaseAttribute
     * @param       $userId
     * @param false $isRefresh
     * @return UserBaseAttributeModel
     * @throws \Throwable
     * @author tioncico
     * Time: 10:03 上午
     */
    public function getUserBaseAttribute($userId,$isRefresh=false): UserBaseAttributeModel
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId,$isRefresh) {
            $data = $redisClient->get($this->getKey("baseAttribute", $userId));
            if ($isRefresh||empty($data)) {
                $data = UserBaseAttributeModel::create()->getInfo($userId);
                $this->setUserBaseAttribute($userId, $data);
            }
            return $data;
        });
    }

    public function getUserAttribute($userId,$isRefresh=false): UserAttributeModel
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId,$isRefresh) {
            $data = $redisClient->get($this->getKey("attribute", $userId));
            if ($isRefresh||empty($data)) {
                $data = UserAttributeModel::create()->getInfo($userId);
                $this->setUserAttribute($userId, $data);
            }
            return $data;
        });
    }

    /**
     * getUserSkillList
     * @param $userId
     * @param $isRefresh
     * @return UserSkillModel[]
     * @throws \Throwable
     * @author tioncico
     * Time: 2:19 下午
     */
    public function getUserSkillList($userId,$isRefresh=false)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId,$isRefresh) {
            $data = $redisClient->get($this->getKey("skillList", $userId));
            if ($isRefresh||empty($data)) {
                $data = SkillService::getInstance()->getUserSkillList($userId);
                $this->setUserSkillList($userId, $data);
            }
            return $data;
        });
    }

    /**
     * getUserPetList
     * @param       $userId
     * @param false $isRefresh
     * @return UserPetModel[]
     * @throws \Throwable
     * @author tioncico
     * Time: 10:03 上午
     */
    public function getUserPetList($userId,$isRefresh=false)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId,$isRefresh) {
            $data = $redisClient->get($this->getKey("petList", $userId));
            if ($isRefresh||empty($data)) {
                $data = PetService::getInstance()->getUserPetList($userId);
                $this->setUserPetList($userId, $data);
            }
            return $data;
        });
    }

    /**
     * getUserEquipmentList
     * @param       $userId
     * @param false $isRefresh
     * @return UserEquipmentBackpackModel[]
     * @throws \Throwable
     * @author tioncico
     * Time: 10:03 上午
     */
    public function getUserEquipmentList($userId,$isRefresh=false)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId,$isRefresh) {
            $data = $redisClient->get($this->getKey("equipmentList", $userId));
            if ($isRefresh||empty($data)) {
                $data = EquipmentService::getInstance()->getUserEquipmentList($userId);
                $this->setUserEquipmentList($userId, $data);
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
