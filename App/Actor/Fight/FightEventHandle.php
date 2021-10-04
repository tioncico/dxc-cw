<?php


namespace App\Actor\Fight;


trait FightEventHandle
{

    public function registerEvent()
    {
        $this->event = new FightEvent(function ($event,...$data){
//                call_user_func($this->callback,$event,...$data);
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
//        $this->event->register('MONSTER_DIE', function () {
//
//        });
        $this->event->register('MONSTER_DIE','reward', function () {
//            $this->
        });

    }
}
