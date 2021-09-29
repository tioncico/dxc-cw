<?php


namespace App\Service\Game\Skill\Effect;


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
    protected $target = 'enemy';//enemy敌人 self自己

    protected $harmType = "harm";//harm伤害 hp 直接扣血

    protected $countStr = "100+{\$attackMax.ddd}";//计算算法

}
