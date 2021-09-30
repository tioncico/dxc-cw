<?php

namespace App\Actor\Skill\Effect;


use App\Service\Game\Attribute;

/**
 * 技能效果[对敌人造成伤害]
 * Class Harm
 * @package App\Service\Game\Skill\Effect
 */
class Harm extends EffectBean
{
    protected $type = 'Harm';
    /**
     * @var string 施加目标
     */
    protected $target = 'enemy';//enemy敌人 self自己 user玩家

    protected $harmType = "harm";//harm伤害 hp 直接扣血

    protected $countStr = "100+{\$attackMax.ddd}";//计算算法

    protected $element = "";

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



}
