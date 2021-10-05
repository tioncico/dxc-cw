<?php


namespace App\Actor\Skill\SkillList;


use App\Actor\Buff\Buff001;
use App\Actor\Buff\BuffBean;
use App\Actor\Skill\Effect\AddBuff;
use App\Actor\Skill\Effect\Effect001;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

class Skill0004 extends SkillBean
{
    protected $skillName = "雷霆万钧";//技能名
    protected $skillCode = "0004";//技能名
    protected $level = 1;//技能等级
    protected $triggerType = '0';//触发类型
    protected $triggerRate = '{$self.hitRate}';//触发概率
    protected $coolingTime = '10';//冷却时间计算  攻速如果为1,那就说明1秒攻击一次,冷却时间为1秒,攻速如果为2,则表示1秒攻击2次,冷却时间为1/2秒,攻速如果为0.5,那代表1秒攻击0.5次,冷却时间为1/0.5=2秒
    protected $manaCost = 0;//mp消耗计算
    protected $description = "雷霆万钧";//介绍

    public function __construct(array $data = null, $autoCreateProperty = false)
    {
        parent::__construct($data, $autoCreateProperty);
        $this->addEffect();
    }

    public function addEffect()
    {
        //新增效果数组
        $effectHarm = new Effect001();
        //获取$skill的属性
        $effectHarm->setName("伤害");
        $effectHarm->setTarget("enemy");
        $effectHarm->setHarmType("harm");
        $effectHarm->setIsCritical(1);
        $effectHarm->setCountStr('100+(100+{$skillInfo.level}*10)/100*{$self.attack}');
        $effectHarm->setElement('{$self.attackElement}');
        $effectHarm->setBuffCode('001');
        $effectHarm->setBuffType('51');
        $effectHarm->setAddMultipleNum('200');


        $this->setEffectParam([
            $effectHarm
        ]);
    }
}
