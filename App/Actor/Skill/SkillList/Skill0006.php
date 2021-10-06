<?php


namespace App\Actor\Skill\SkillList;


use App\Actor\Buff\Buff001;
use App\Actor\Buff\Buff002;
use App\Actor\Buff\BuffBean;
use App\Actor\Skill\Effect\AddBuff;
use App\Actor\Skill\Effect\ChangeProperty;
use App\Actor\Skill\Effect\Effect001;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

class Skill0006 extends SkillBean
{
    protected $skillName = "治疗光环";//技能名
    protected $skillCode = "0006";//技能名
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
        $buffBean = new Buff002();
        $buffBean->setIsDeBuff(0);
        $buffBean->setLevel(1);
        $buffBean->setBuffLayer(1);
        $buffBean->setMaxBuffLayer(1);
        $buffBean->setExpireType(1);
        $buffBean->setExpireTime(10);
        $buffBean->setNumCount('(4+({$buffInfo.level}*0.3))*{$selfBase.hp}/100');
        $buffBean->setPropertyName('hp');

        $addBuff = new AddBuff();
        $addBuff->setTarget("self");
        $addBuff->setBuffBean($buffBean);
        $addBuff->setBuffCode($buffBean->getBuffCode());


        $this->setEffectParam([
            $addBuff
        ]);
    }
}
