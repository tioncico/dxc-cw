<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\Effect\AddBuff;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait EffectAddBuff
{
    /**
     * 效果,伤害
     * effectHarm
     * @param Attribute $targetBaseAttribute
     * @param Attribute $targetAttribute
     * @param SkillBean $skillInfo
     * @param Harm      $effectBean
     * @return SkillEffectResult
     * @author tioncico
     * Time: 9:27 上午
     */
    public function addBuff(Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, AddBuff $effectBean)
    {
        $skillEffectResult = new SkillEffectResult(['effectName'=>$effectBean->getName(),'effectType'=>$effectBean->getType()]);
        $skillEffectResult->setTargetType($this->getEffectTargetType($effectBean->getTarget()));
        $buffBean = $effectBean->getBuffBean();
        $targetAttribute->addBuff($buffBean,$effectBean->getBuffLayer());


        return $skillEffectResult;
    }
}
