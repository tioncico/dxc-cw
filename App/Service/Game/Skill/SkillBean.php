<?php


namespace App\Service\Game\Skill;


use EasySwoole\Spl\SplBean;

class SkillBean extends SplBean
{
    protected $skillName;//技能名
    protected $level;//技能等级
    protected $triggerType;//触发类型
    protected $triggerRate;//触发类型
    protected $coolingTime;//冷却时间计算
    protected $manaCost;//mp消耗计算
    protected $description;//介绍
    protected $effectParam;//效果数组
    protected $tickTime = 0;//冷却时间


}
