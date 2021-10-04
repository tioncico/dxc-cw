<?php

namespace App\Actor\Skill;


use App\Actor\Skill\Effect\EffectBean;
use EasySwoole\Spl\SplBean;

class SkillBean extends SplBean
{
    protected $skillName;//技能名
    protected $skillCode;//技能code
    protected $level;//技能等级
    protected $triggerType;//触发类型
    protected $triggerRate;//触发概率
    protected $coolingTime;//冷却时间计算
    protected $manaCost;//mp消耗计算
    protected $description;//介绍

    /**
     * @var EffectBean[]
     */
    protected $effectParam=[];//效果数组
    protected $tickTime = 0.00;//冷却时间

    /**
     *
     * @return mixed
     */
    public function getSkillName()
    {
        return $this->skillName;
    }

    /**
     * @param mixed $skillName
     */
    public function setSkillName($skillName): void
    {
        $this->skillName = $skillName;
    }

    /**
     * @return mixed
     */
    public function getSkillCode()
    {
        return $this->skillCode;
    }

    /**
     * @param mixed $skillCode
     */
    public function setSkillCode($skillCode): void
    {
        $this->skillCode = $skillCode;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getTriggerType()
    {
        return $this->triggerType;
    }

    /**
     * @param mixed $triggerType
     */
    public function setTriggerType($triggerType): void
    {
        $this->triggerType = $triggerType;
    }

    /**
     * @return mixed
     */
    public function getTriggerRate()
    {
        return $this->triggerRate;
    }

    /**
     * @param mixed $triggerRate
     */
    public function setTriggerRate($triggerRate): void
    {
        $this->triggerRate = $triggerRate;
    }

    /**
     * @return mixed
     */
    public function getCoolingTime()
    {
        return $this->coolingTime;
    }

    /**
     * @param mixed $coolingTime
     */
    public function setCoolingTime($coolingTime): void
    {
        $this->coolingTime = $coolingTime;
    }

    /**
     * @return mixed
     */
    public function getManaCost()
    {
        return $this->manaCost;
    }

    /**
     * @param mixed $manaCost
     */
    public function setManaCost($manaCost): void
    {
        $this->manaCost = $manaCost;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEffectParam()
    {
        return $this->effectParam;
    }

    /**
     * @param mixed $effectParam
     */
    public function setEffectParam($effectParam): void
    {
        $this->effectParam = $effectParam;
    }

    /**
     * @return float
     */
    public function getTickTime(): float
    {
        return $this->tickTime;
    }

    /**
     * @param float $tickTime
     */
    public function setTickTime(float $tickTime): void
    {
        $this->tickTime = $tickTime;
    }

    /**
     * @param float $tickTime
     */
    public function incTickTime(float $tickTime): void
    {
        $this->tickTime += $tickTime;
    }

}
