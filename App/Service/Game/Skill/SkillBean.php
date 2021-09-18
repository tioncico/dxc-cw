<?php


namespace App\Service\Game\Skill;


use EasySwoole\Spl\SplBean;

class SkillBean extends SplBean
{
    protected $skillCode;//技能code
    protected $skillName;//技能名
    protected $isUse;//是否谢爱
    protected $level;//技能等级
    protected $type;//0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发,10释放技能前触发,11释放技能后触发
    protected $rarityLevel;//技能罕见等级
    protected $maxLevel;//最大等级
    protected $coolingTime;//冷却时间
    protected $manaCostQualification;//法力消耗
    protected $entryCode;//词条code
    protected $description;//介绍
    protected $param;//参数
    protected $qualification;//资质
    protected $manaCost;//mp消耗
    protected $tickTime = 0;//冷却时间

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
    public function getIsUse()
    {
        return $this->isUse;
    }

    /**
     * @param mixed $isUse
     */
    public function setIsUse($isUse): void
    {
        $this->isUse = $isUse;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getRarityLevel()
    {
        return $this->rarityLevel;
    }

    /**
     * @param mixed $rarityLevel
     */
    public function setRarityLevel($rarityLevel): void
    {
        $this->rarityLevel = $rarityLevel;
    }

    /**
     * @return mixed
     */
    public function getMaxLevel()
    {
        return $this->maxLevel;
    }

    /**
     * @param mixed $maxLevel
     */
    public function setMaxLevel($maxLevel): void
    {
        $this->maxLevel = $maxLevel;
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
    public function getManaCostQualification()
    {
        return $this->manaCostQualification;
    }

    /**
     * @param mixed $manaCostQualification
     */
    public function setManaCostQualification($manaCostQualification): void
    {
        $this->manaCostQualification = $manaCostQualification;
    }

    /**
     * @return mixed
     */
    public function getEntryCode()
    {
        return $this->entryCode;
    }

    /**
     * @param mixed $entryCode
     */
    public function setEntryCode($entryCode): void
    {
        $this->entryCode = $entryCode;
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
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     */
    public function setParam($param): void
    {
        $this->param = $param;
    }

    /**
     * @return mixed
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * @param mixed $qualification
     */
    public function setQualification($qualification): void
    {
        $this->qualification = $qualification;
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
     * @return int
     */
    public function getTickTime(): int
    {
        return $this->tickTime;
    }

    /**
     * @param int $tickTime
     */
    public function setTickTime(int $tickTime): void
    {
        $this->tickTime = $tickTime;
    }

    public function incTickTime($tickTime): void
    {
        $this->tickTime += $tickTime;
    }

}
