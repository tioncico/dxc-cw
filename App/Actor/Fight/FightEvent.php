<?php


namespace App\Actor\Fight;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillBean;

class FightEvent
{
    protected $container = [
        'FIGHT_START'                  => [],
        'FIGHT_END'                    => [],
        'USER_NORMAL_ATTACK_BEFORE'    => [],
        'USER_NORMAL_ATTACK_AFTER'     => [],
        'PET_NORMAL_ATTACK_BEFORE'     => [],
        'PET_NORMAL_ATTACK_AFTER'      => [],
        'MONSTER_NORMAL_ATTACK_BEFORE' => [],
        'MONSTER_NORMAL_ATTACK_AFTER'  => [],
        'USER_BUCKLE_BLOOD_BEFORE'     => [],
        'USER_BUCKLE_BLOOD_AFTER'      => [],
        'MONSTER_BUCKLE_BLOOD_BEFORE'  => [],
        'MONSTER_BUCKLE_BLOOD_AFTER'   => [],
        'USER_SKILL_BEFORE'            => [],
        'USER_SKILL_AFTER'             => [],
        'PET_SKILL_BEFORE'             => [],
        'PET_SKILL_AFTER'              => [],
        'MONSTER_SKILL_BEFORE'         => [],
        'MONSTER_SKILL_AFTER'          => [],
        'SECOND'                       => [],
        'SECOND_01'                    => [],
        'USER_DIE'                     => [],
        'MONSTER_DIE'                  => [],
    ];
//战斗事件
## 触发类型


//- 主动触发 0
//- 进入战斗前触发 11
//- 进入战斗后触发 12
//- 玩家普通攻击前触发 21
//- 玩家普通攻击后触发 22
//- 宠物普通攻击前触发 31
//- 宠物普通攻击后触发 32
//- 怪物普通攻击前触发 41
//- 怪物普通攻击后触发 42
//- 玩家被扣血触发 51
//- 怪物被扣血触发 52
//- 玩家释放技能前触发 61
//- 玩家释放技能后触发 62
//- 怪物释放技能前触发 71
//- 怪物释放技能后触发 72
//- 一秒触发一次 80
//- 战斗结束前触发 91
//- 战斗结束后触发 92
//
    public function register($event, $name, callable $callback)
    {
        $this->container[$event][$name] = $callback;
    }

    public function onEvent($event,...$data)
    {
//        var_dump("触发事件{$event}");
        foreach ($this->container[$event] as $name => $callable) {
            call_user_func($callable, $name,...$data);
        }
    }

    const EVENT_LIST = [
        'FIGHT_START'                  => 'fightStart',//'战斗开始前',
        'FIGHT_END'                    => 'fightEnd',//'战斗结束后',
        'USER_NORMAL_ATTACK_BEFORE'    => 'userNormalAttackBefore',//'玩家普通攻击前',
        'USER_NORMAL_ATTACK_AFTER'     => 'userNormalAttackAfter',//'玩家普通攻击后',
        'PET_NORMAL_ATTACK_BEFORE'     => 'petNormalAttackBefore',//'玩家普通攻击前',
        'PET_NORMAL_ATTACK_AFTER'      => 'petNormalAttackAfter',//'玩家普通攻击后',
        'MONSTER_NORMAL_ATTACK_BEFORE' => 'monsterNormalAttackBefore',//'怪物普通攻击前',
        'MONSTER_NORMAL_ATTACK_AFTER'  => 'monsterNormalAttackAfter',//'怪物普通攻击后',
        'USER_BUCKLE_BLOOD_BEFORE'     => 'userBuckleBloodBefore',//'用户扣血前',
        'USER_BUCKLE_BLOOD_AFTER'      => 'userBuckleBloodAfter',//'用户扣血后',
        'MONSTER_BUCKLE_BLOOD_BEFORE'  => 'monsterBuckleBloodBefore',//'怪物扣血前',
        'MONSTER_BUCKLE_BLOOD_AFTER'   => 'monsterBuckleBloodAfter',//'怪物扣血后',
        'USER_SKILL_BEFORE'            => 'userSkillBefore',//'玩家释放技能前',
        'USER_SKILL_AFTER'             => 'userSkillAfter',//'玩家释放技能后',
        'PET_SKILL_BEFORE'             => 'petSkillBefore',//'玩家释放技能前',
        'PET_SKILL_AFTER'              => 'petSkillAfter',//'玩家释放技能后',
        'MONSTER_SKILL_BEFORE'         => 'monsterSkillBefore',//'怪物释放技能前',
        'MONSTER_SKILL_AFTER'          => 'monsterSkillAfter',//'怪物释放技能后',
        'SECOND'                       => 'second',//'一秒触发一次',
        'SECOND_01'                    => 'second01',//'0.1秒触发一次',
        'USER_DIE'                     => 'userDie',//玩家死亡
        'MONSTER_DIE'                  => 'monsterDie',//怪物死亡
    ];

    public function fightStart()
    {
        $this->onEvent('FIGHT_START');
    }

    public function fightEnd()
    {
        $this->onEvent('FIGHT_END');
    }

    public function userNormalAttackBefore(Attribute $attribute)
    {
        $this->onEvent('USER_NORMAL_ATTACK_BEFORE');
    }

    public function userNormalAttackAfter(Attribute $attribute)
    {
        $this->onEvent('USER_NORMAL_ATTACK_AFTER');
    }

    public function petNormalAttackBefore(Attribute $attribute)
    {
        $this->onEvent('PET_NORMAL_ATTACK_BEFORE');
    }

    public function petNormalAttackAfter(Attribute $attribute)
    {
        $this->onEvent('PET_NORMAL_ATTACK_AFTER');
    }

    public function monsterNormalAttackBefore(Attribute $attribute)
    {
        $this->onEvent('MONSTER_NORMAL_ATTACK_BEFORE');
    }

    public function monsterNormalAttackAfter(Attribute $attribute)
    {
        $this->onEvent('MONSTER_NORMAL_ATTACK_AFTER');
    }

    public function userBuckleBloodBefore()
    {
        $this->onEvent('USER_BUCKLE_BLOOD_BEFORE');
    }

    public function userBuckleBloodAfter()
    {
        $this->onEvent('USER_BUCKLE_BLOOD_AFTER');
    }

    public function monsterBuckleBloodBefore()
    {
        $this->onEvent('MONSTER_BUCKLE_BLOOD_BEFORE');
    }

    public function monsterBuckleBloodAfter()
    {
        $this->onEvent('MONSTER_BUCKLE_BLOOD_AFTER');
    }

    public function userSkillBefore(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('USER_SKILL_BEFORE');
    }

    public function userSkillAfter(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('USER_SKILL_AFTER');
    }

    public function petSkillBefore(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('PET_SKILL_BEFORE');
    }

    public function petSkillAfter(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('PET_SKILL_AFTER');
    }

    public function monsterSkillBefore(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('MONSTER_SKILL_BEFORE');
    }

    public function monsterSkillAfter(Attribute $attribute,SkillBean $skillBean)
    {
        $this->onEvent('MONSTER_SKILL_AFTER');
    }

    public function second()
    {
        $this->onEvent('SECOND');
    }

    public function second01()
    {
        $this->onEvent('SECOND_01');
    }

    public function userDie()
    {
        $this->onEvent('USER_DIE');
    }

    public function monsterDie()
    {
        $this->onEvent('MONSTER_DIE');
    }


}
