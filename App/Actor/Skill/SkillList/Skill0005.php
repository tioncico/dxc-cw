<?php


namespace App\Actor\Skill\SkillList;


use App\Actor\Buff\Buff001;
use App\Actor\Buff\BuffBean;
use App\Actor\Skill\Effect\AddBuff;
use App\Actor\Skill\Effect\ChangeProperty;
use App\Actor\Skill\Effect\Effect001;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

class Skill0005 extends SkillBean
{
    protected $skillName = "治疗术";//技能名
    protected $skillCode = "0005";//技能名
    protected $level = 1;//技能等级
    protected $triggerType = '0';//触发类型
    protected $triggerRate = '100';//触发概率
    protected $coolingTime = '10';//冷却时间计算
    protected $manaCost = "10";//mp消耗计算
    protected $description = "治疗术";//介绍

    public function __construct(array $data = null, $autoCreateProperty = false)
    {
        parent::__construct($data, $autoCreateProperty);
        $this->addEffect();
    }

    public function addEffect()
    {
        //新增效果数组
        $effect = new ChangeProperty();
        //获取$skill的属性
        $effect->setName("治疗");
        $effect->setTarget('self');
        $effect->setNumCount('(10+({$skillInfo.level}*2))*{$selfBase.hp}/100');
        $effect->setPropertyName("hp");
        $this->setEffectParam([
            $effect
        ]);
    }
}
