<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;
use EasySwoole\Spl\SplBean;

class FightResult extends SplBean
{
    protected $name;//攻击名称
    /**
     * @var $attack Attribute
     */
    protected $attack;//攻击人
    /**
     * @var $attack Attribute
     */
    protected $beAttack;//被攻击人
    protected $skillInfo;//是否附带技能
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
     * @return Attribute
     */
    public function getAttack(): Attribute
    {
        return $this->attack;
    }

    /**
     * @param Attribute $attack
     */
    public function setAttack(Attribute $attack): void
    {
        $this->attack = $attack;
    }

    /**
     * @return Attribute
     */
    public function getBeAttack(): Attribute
    {
        return $this->beAttack;
    }

    /**
     * @param Attribute $beAttack
     */
    public function setBeAttack(Attribute $beAttack): void
    {
        $this->beAttack = $beAttack;
    }





}
