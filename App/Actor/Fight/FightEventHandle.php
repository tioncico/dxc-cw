<?php


namespace App\Actor\Fight;


use App\Actor\Buff\BuffManager;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait FightEventHandle
{

    public function registerEvent()
    {
        $this->event = new FightEvent(function ($event, ...$data) {
            call_user_func($this->callback, $event, ...$data);
        });
        //普通攻击
        $this->event->register('FIGHT_START', 'normalAttack', function () {
            Logger::getInstance()->console("{$this->userAttribute->getName()} lv:{$this->userAttribute->getLevel()}");
            Logger::getInstance()->console("{$this->monsterAttribute->getName()} lv:{$this->monsterAttribute->getLevel()}");
        });
        //普通攻击
        $this->event->register('SECOND_01', 'normalAttack', function () {
            $this->normalAttack();
        });
        //全局技能冷却
        $this->event->register('SECOND_01', 'skillCool', function () {
            $this->userAttribute->getSkillManager()->decCoolSkill(0.1);
            $this->monsterAttribute->getSkillManager()->decCoolSkill(0.1);
            foreach ($this->petAttributeList as $petAttribute) {
//                $petAttribute->getSkillManager()->decCoolSkill(0.1);
            }
        });
        //全局buff过期
        $this->event->register('SECOND_01', 'buffCool', function () {
            /**
             * @var $buffManager BuffManager
             */
            $buffManager = $this->userAttribute->getBuffManager();
            $buffManager->decExpireBuff(0.1);

            $buffManager = $this->monsterAttribute->getBuffManager();
            $buffManager->decExpireBuff(0.1);
            foreach ($this->petAttributeList as $petAttribute) {
                $buffManager = $petAttribute->getBuffManager();
//                $buffManager->decExpireBuff(0.1);
            }
        });
//        $this->event->register('MONSTER_DIE', function () {
//
//        });
        $this->event->register('MONSTER_DIE', 'reward', function () {
//            $this->
        });
        $this->buckleBloodEvent();

    }

    public function buckleBloodEvent()
    {
        $this->event->register('MONSTER_BUCKLE_BLOOD_BEFORE', 'buffTrigger', function ($event,Attribute $targetAttribute, SkillEffectResult $effectResult) {
            $targetAttribute->getBuffManager()->trigger( 51,null, $effectResult);
            $targetAttribute->getSkillManager()->trigger( 51,null, $effectResult);
        });
        $this->event->register('MONSTER_BUCKLE_BLOOD_AFTER', 'buffTrigger', function ($event,Attribute $targetAttribute, SkillEffectResult $effectResult) {
            $targetAttribute->getSkillManager()->trigger( 52,null, $effectResult);
        });
    }
}
