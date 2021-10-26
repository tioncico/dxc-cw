<?php


namespace App\Actor\Data;


use App\Actor\Buff\BuffManager;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Actor\Skill\SkillManager;
use App\Service\Game\UserService;
use App\Utility\Cache\UserCache;

class User
{
    /**
     * @var Attribute
     */
    public $userBaseAttribute;
    /**
     * @var Attribute
     */
    public $userAttribute;
    public $userEquipmentList;
    public $userPetList;
    public $userSkillList;
    public $userNowAttribute = null;

    public function __construct($userId)
    {
        $this->userBaseAttribute = UserCache::getInstance()->getUserBaseAttribute($userId);
        $this->initUserAttribute($userId);
        $this->userEquipmentList = UserCache::getInstance()->getUserEquipmentList($userId);
        $this->userPetList = UserCache::getInstance()->getUserPetList($userId);
//        $this->userSkillList = UserCache::getInstance()->getUserSkillList($userId);
    }

    public function initUserAttribute($userId)
    {
        $userAttributeModel = UserService::getInstance()->countFightAttribute($userId);
        $userAttribute = new Attribute($userAttributeModel->toArray());

        //初始化技能
        $skillObjList = [];
        $userSkillList = UserCache::getInstance()->getUserSkillList($userId);
        foreach ($userSkillList as $userSkillModel) {
            $className = "\\App\\Actor\\Skill\\SkillList\\Skill{$userSkillModel->entryCode}";
            if (class_exists($className)) {
                $skillInfo = new $className($userSkillModel->toArray());
                $skillObjList[$userSkillModel->entryCode] = $skillInfo;
            }
        }
        $userAttribute->setSkillList($skillObjList);
        $userAttribute->setOriginModel($userAttributeModel);
        $this->userAttribute = $userAttribute;
        //初始化buff
        $buffManager = new BuffManager($userAttribute, $this->getUserNowAttribute());
        $userAttribute->setBuffManager($buffManager);
        $this->getUserNowAttribute()->setBuffManager($buffManager);
    }

    public function getUserNowAttribute()
    {
        if (empty($this->userNowAttribute)) {
            $this->userNowAttribute = new Attribute($this->userAttribute->toArray());
        }
        return $this->userNowAttribute;
    }

    public function toArray()
    {
        return [
            'userAttribute'     => $this->userAttribute,
            'userEquipmentList' => $this->userEquipmentList,
            'userPetList'       => $this->userPetList,
            'userNowAttribute'  => $this->userNowAttribute,
        ];
    }

}
