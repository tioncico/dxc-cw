<?php


namespace App\Utility\Cache;


use App\Actor\Cache\UserRelationUserActor;
use App\Actor\UserActor;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserPetModel;
use App\Model\Game\UserSkillModel;
use App\Service\Game\EquipmentService;
use App\Service\Game\PetService;
use App\Service\Game\SkillService;

class UserCache
{
    protected $userId;
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

    public function __construct(Channel $mailBox, string $actorId, $arg)
    {
        parent::__construct($mailBox, $actorId, $arg);
        $this->userId = $arg['userId'];
    }

    protected function onStart()
    {
        $userId = $this->userId;
        //初始化用户信息
        $this->userBaseAttribute = UserBaseAttributeModel::create()->getInfo($userId);
        $this->userAttribute = UserAttributeModel::create()->getInfo($userId);
        $this->userEquipmentList = EquipmentService::getInstance()->getUserEquipmentList($userId);
        $this->userSkillList = SkillService::getInstance()->getUserSkillList($userId);
        $this->userPetList = PetService::getInstance()->getUserPetList($userId);


    }

    public static function getUserActorId($userId)
    {
        $actorId = UserRelationUserActor::getInstance()->getUserActor($userId);
        if (empty($actorId)) {
            //创建actor
            $actorId = UserActor::client()->create(['userId' => $userId]);   // 00101000000000000000001
            //创建关联关系
            UserRelationUserActor::getInstance()->addUserActor($userId, $actorId);
        }
        return $actorId;
    }
}
