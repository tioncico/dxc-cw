<?php

namespace App\Actor\Skill\Effect;


use App\Service\Game\Attribute;

/**
 * 技能效果[造成伤害]
 * Class Harm
 * @package App\Service\Game\Skill\Effect
 */
class Harm extends EffectBean
{
    protected $type = 'harm';
    /**
     * @var string 施加目标
     */
    protected $target = 'enemy';//enemy敌人 self自己 user玩家

    protected $harmType = "harm";//harm伤害 hp 直接扣血

    protected $countStr = "0";//计算算法

    protected $element = '{$self.attackElement}';//攻击元素

    protected $isCritical=0;//是否可以暴击

    protected $criticalRate='{$self.criticalRate}';//暴击率

    protected $criticalStrikeDamage = '{$self.criticalStrikeDamage}';//暴击效果

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType( $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    /**
     * @return string
     */
    public function getHarmType(): string
    {
        return $this->harmType;
    }

    /**
     * @param string $harmType
     */
    public function setHarmType(string $harmType): void
    {
        $this->harmType = $harmType;
    }

    /**
     * @return string
     */
    public function getCountStr(): string
    {
        return $this->countStr;
    }

    /**
     * @param string $countStr
     */
    public function setCountStr(string $countStr): void
    {
        $this->countStr = $countStr;
    }

    /**
     * @return int
     */
    public function getElement(): string
    {
        return $this->element;
    }

    /**
     * @param $element
     */
    public function setElement( $element): void
    {
        $this->element = $element;
    }

    /**
     * @return int
     */
    public function getIsCritical(): int
    {
        return $this->isCritical;
    }

    /**
     * @param int $isCritical
     */
    public function setIsCritical(int $isCritical): void
    {
        $this->isCritical = $isCritical;
    }

    /**
     * @return string
     */
    public function getCriticalRate(): string
    {
        return $this->criticalRate;
    }

    /**
     * @param string $criticalRate
     */
    public function setCriticalRate(string $criticalRate): void
    {
        $this->criticalRate = $criticalRate;
    }

    /**
     * @return string
     */
    public function getCriticalStrikeDamage(): string
    {
        return $this->criticalStrikeDamage;
    }

    /**
     * @param string $criticalStrikeDamage
     */
    public function setCriticalStrikeDamage(string $criticalStrikeDamage): void
    {
        $this->criticalStrikeDamage = $criticalStrikeDamage;
    }
}
