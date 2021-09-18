<?php


namespace App\Service\Game\Skill;


class SkillManager
{
    protected $skillList;

    public function __construct()
    {

    }

    public function addSkill(SkillBean $skillBean){
        $this->skillList[$skillBean->getType()][$skillBean->getSkillCode()] = $skillBean;
    }

    /**
     * onEvent 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发,10释放技能前触发,11释放技能后触发
     * @param $type
     * @param $skillCode
     * @author tioncico
     * Time: 2:58 下午
     */
    public function onEvent($type,$skillCode = null){



    }


}
