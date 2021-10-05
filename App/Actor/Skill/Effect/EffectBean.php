<?php


namespace App\Actor\Skill\Effect;


use App\Service\Game\Attribute;
use App\Service\Game\Skill\SkillBean;
use EasySwoole\Spl\SplBean;

class EffectBean extends SplBean
{
    protected $type='';//效果类型
    /**
     * @var string 施加目标
     */
    protected $target = 'enemy';//enemy敌人 self自己 user 玩家

    protected $name='';//效果名称

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
