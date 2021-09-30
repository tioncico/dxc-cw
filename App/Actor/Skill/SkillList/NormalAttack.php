<?php

namespace App\Actor\Skill\SkillList;


use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;

class NormalAttack extends SkillBean
{
    protected $skillName = "普通攻击";//技能名
    protected $skillCode = "0001";//技能名
    protected $level = 1;//技能等级
    protected $triggerType = '0';//触发类型
    protected $triggerRate = '{$self.hitRate}-{$enemy.dodgeRate}';//触发概率
    protected $coolingTime = '1/{$self.attackSpeed}';//冷却时间计算  攻速如果为1,那就说明1秒攻击一次,冷却时间为1秒,攻速如果为2,则表示1秒攻击2次,冷却时间为1/2秒,攻速如果为0.5,那代表1秒攻击0.5次,冷却时间为1/0.5=2秒
    protected $manaCost = 0;//mp消耗计算
    protected $description = "普通攻击";//介绍
    protected $effectParam = [];//效果数组
    protected $tickTime = 0;//冷却时间


    public function __construct(array $data = null, $autoCreateProperty = false)
    {
        parent::__construct($data, $autoCreateProperty);
        //新增效果数组
        $effectHarm = new Harm();
        //获取$skill的属性
        $effectHarm->setName("伤害");
        $effectHarm->setTarget("enemy");
        $effectHarm->setHarmType("harm");
        $effectHarm->setCountStr('{$self.attack}+1');
        $effectHarm->setElement('{$self.attackElement}');
        $this->setEffectParam([
            $effectHarm
        ]);
    }


}
