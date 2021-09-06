<?php


namespace App\Service\Game;


use EasySwoole\Spl\SplBean;

class SkillAttribute extends SplBean
{
    protected $skillId;
    protected $level;
    protected $rarityLevel;
    protected $maxLevel;
    protected $coolingTime;
    protected $manaCost;
    protected $entryCode;
    protected $description;
    protected $param;
    protected $qualification;
    protected $manaCostQualification;

    /**
     * @return mixed
     */
    public function getSkillId()
    {
        return $this->skillId;
    }

    /**
     * @param mixed $skillId
     */
    public function setSkillId($skillId): void
    {
        $this->skillId = $skillId;
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

}
