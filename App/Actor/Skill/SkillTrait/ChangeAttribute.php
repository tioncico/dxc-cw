<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\FightEvent;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait ChangeAttribute
{
    public function changeAttribute(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        Logger::getInstance()->console("属性变动触发");
        if ($effectResult->getEffectType()=='harm'){
            $this->triggerBuckleBloodEventBefore($targetAttribute,$effectResult);
            $this->harm($targetAttribute,$effectResult);
            $this->triggerBuckleBloodEventAfter($targetAttribute,$effectResult);
        }
    }

    public function harm(Attribute $targetAttribute, SkillEffectResult $effectResult){
        //扣除血量
        $buckleBloodNum = $effectResult->getBuckleBloodNum();
        Logger::getInstance()->console("实际扣血{$buckleBloodNum}  {$targetAttribute->getName()} hp:{$targetAttribute->getHp()}");
        if ($buckleBloodNum==0){
            return true;
        }
        $targetAttribute->incHp(-$buckleBloodNum);
    }

    public function triggerBuckleBloodEventBefore(Attribute $targetAttribute, SkillEffectResult $effectResult){
        /**
         * @var $event FightEvent
         */
        $event = $this->fight->getEvent();
        if ($targetAttribute->getAttributeType()==1){
            $event->userBuckleBloodBefore($targetAttribute,$effectResult);
        }
        if ($targetAttribute->getAttributeType()==3){
            $event->monsterBuckleBloodBefore($targetAttribute,$effectResult);
        }
    }

    public function triggerBuckleBloodEventAfter(Attribute $targetAttribute, SkillEffectResult $effectResult){
        /**
         * @var $event FightEvent
         */
        $event = $this->fight->getEvent();
        if ($targetAttribute->getAttributeType()==1){
            $event->userBuckleBloodAfter($targetAttribute,$effectResult);
        }
        if ($targetAttribute->getAttributeType()==3){
            $event->monsterBuckleBloodAfter($targetAttribute,$effectResult);
        }
    }
}
