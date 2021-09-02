<?php


namespace App\Service\Game\Fight;


use EasySwoole\Spl\SplBean;

class FightResult extends SplBean
{
    protected $isCritical=false;//是否暴击
    protected $isHit=true;//是否命中
    protected $harmNum=0;//初始伤害
    protected $buckleBloodNum=0;//扣血
    protected $attackElement=null;//攻击元素
    protected $elementHarm=0;//元素伤害

    /**
     * @return null
     */
    public function getAttackElement()
    {
        return $this->attackElement;
    }

    /**
     * @param null $attackElement
     */
    public function setAttackElement($attackElement): void
    {
        $this->attackElement = $attackElement;
    }

    /**
     * @return int
     */
    public function getElementHarm(): int
    {
        return $this->elementHarm;
    }

    /**
     * @param int $elementHarm
     */
    public function setElementHarm(int $elementHarm): void
    {
        $this->elementHarm = $elementHarm;
    }


    /**
     * @return mixed
     */
    public function getIsCritical()
    {
        return $this->isCritical;
    }

    /**
     * @param mixed $isCritical
     */
    public function setIsCritical($isCritical): void
    {
        $this->isCritical = $isCritical;
    }

    /**
     * @return mixed
     */
    public function getIsHit()
    {
        return $this->isHit;
    }

    /**
     * @param mixed $isHit
     */
    public function setIsHit($isHit): void
    {
        $this->isHit = $isHit;
    }

    /**
     * @return mixed
     */
    public function getHarmNum()
    {
        return $this->harmNum;
    }

    /**
     * @param mixed $harmNum
     */
    public function setHarmNum($harmNum): void
    {
        $this->harmNum = $harmNum;
    }

    /**
     * @return mixed
     */
    public function getBuckleBloodNum()
    {
        return $this->buckleBloodNum;
    }

    /**
     * @param mixed $buckleBloodNum
     */
    public function setBuckleBloodNum($buckleBloodNum): void
    {
        $this->buckleBloodNum = $buckleBloodNum;
    }

}
