<?php

namespace App\Actor\Skill\Effect;


use App\Actor\Buff\BuffBean;
use App\Service\Game\Attribute;

/**
 * 技能效果[叠加buff]
 * Class Harm
 * @package App\Service\Game\Skill\Effect
 */
class AddBuff extends EffectBean
{
    protected $name = "叠加buff";
    protected $type = 'addBuff';
    /**
     * @var string 施加目标
     */
    protected $target = 'enemy';//enemy敌人 self自己 user玩家

    protected $buffLayer = '1';//叠加buff层数

    protected $buffCode = '0000';//buffcode

    /**
     * @var null|BuffBean
     */
    protected $buffBean = null;//buff

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
    public function setType(string $type): void
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
    public function getBuffLayer(): string
    {
        return $this->buffLayer;
    }

    /**
     * @param string $buffLayer
     */
    public function setBuffLayer(string $buffLayer): void
    {
        $this->buffLayer = $buffLayer;
    }

    /**
     * @return string
     */
    public function getBuffCode(): string
    {
        return $this->buffCode;
    }

    /**
     * @param string $buffCode
     */
    public function setBuffCode(string $buffCode): void
    {
        $this->buffCode = $buffCode;
    }

    /**
     * @return BuffBean|null
     */
    public function getBuffBean(): ?BuffBean
    {
        return $this->buffBean;
    }

    /**
     * @param BuffBean|null $buffBean
     */
    public function setBuffBean(?BuffBean $buffBean): void
    {
        $this->buffBean = $buffBean;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
