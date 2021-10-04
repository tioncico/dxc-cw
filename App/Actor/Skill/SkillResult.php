<?php


namespace App\Actor\Skill;


use App\Actor\Skill\Effect\EffectBean;
use EasySwoole\Spl\SplBean;

class SkillResult extends SplBean
{
    protected $skillInfo;//技能信息
    protected $isMiss = 0;//是否miss
    protected $manaCostNum = 0;//耗蓝
    protected $effectList = [];//作用到谁的身上

    /**
     * @return int
     */
    public function getManaCostNum(): int
    {
        return $this->manaCostNum;
    }

    /**
     * @param int $manaCostNum
     */
    public function setManaCostNum(int $manaCostNum): void
    {
        $this->manaCostNum = $manaCostNum;
    }


    /**
     * @return mixed
     */
    public function getSkillInfo()
    {
        return $this->skillInfo;
    }

    /**
     * @param mixed $skillInfo
     */
    public function setSkillInfo($skillInfo): void
    {
        $this->skillInfo = $skillInfo;
    }

    /**
     * @return array[]
     */
    public function getEffectList(): array
    {
        return $this->effectList;
    }

    /**
     * @param array[] $effectList
     */
    public function setEffectList(array $effectList): void
    {
        $this->effectList = $effectList;
    }

    public function addEffectResult(SkillEffectResult $effectBean)
    {
        $this->effectList[] = $effectBean;
    }

    /**
     * @return int
     */
    public function getIsMiss(): int
    {
        return $this->isMiss;
    }

    /**
     * @param int $isMiss
     */
    public function setIsMiss(int $isMiss): void
    {
        $this->isMiss = $isMiss;
    }


}
