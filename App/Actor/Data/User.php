<?php


namespace App\Actor\Data;


use App\Utility\Cache\UserCache;

class User
{
    public $userBaseAttribute;
    public $userAttribute;
    public $userEquipmentList;
    public $userPetList;
    public $userSkillList;
    public $userNowAttribute;

    public function __construct($userId)
    {
        $this->userBaseAttribute = UserCache::getInstance()->getUserBaseAttribute($userId);
        $this->userAttribute = UserCache::getInstance()->getUserAttribute($userId);
        $this->userEquipmentList = UserCache::getInstance()->getUserEquipmentList($userId);
        $this->userPetList = UserCache::getInstance()->getUserPetList($userId);
        $this->userSkillList = UserCache::getInstance()->getUserSkillList($userId);
    }

    public function initUserNowAttribute()
    {
        $this->userNowAttribute = $this->userAttribute;
    }

    public function toArray(){
        return [
              'userBaseAttribute'=>$this->userBaseAttribute,
              'userAttribute'=>$this->userAttribute,
              'userEquipmentList'=>$this->userEquipmentList,
              'userPetList'=>$this->userPetList,
              'userSkillList'=>$this->userSkillList,
              'userNowAttribute'=>$this->userNowAttribute,
        ];
    }

}
