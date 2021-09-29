<?php


namespace App\Service\Game\Skill\Effect;


use App\Service\Game\Attribute;
use App\Service\Game\Skill\SkillBean;
use EasySwoole\Spl\SplBean;

class EffectBean extends SplBean
{
    protected $type;//效果类型
    /**
     * @var string 施加目标
     */
    protected $target = 'enemy';//enemy敌人 self自己

}
