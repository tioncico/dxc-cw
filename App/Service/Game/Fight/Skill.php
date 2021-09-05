<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;
use App\Service\Game\SkillAttribute;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;

class Skill
{
    /**
     * 造成xx%伤害
     * entry3001
     * @param Attribute      $attack
     * @param Attribute      $beAttack
     * @param SkillAttribute $skillAttribute
     * @author tioncico
     * Time: 7:27 下午
     */
    public static function entry3001(Attribute $attack, Attribute $beAttack, SkillAttribute $skillAttribute, FightResult $fightResult)
    {
        $paramData = json_decode($skillAttribute->getParam(), true);
        $num = $paramData[0] ?? 0;
        //伤害计算
        //可能暴击
        $attackNum = $attack->getAttack();
        $harm = $attackNum;
        //技能额外增加伤害
        $harm = $harm+intval($harm*$num/100);
        if ($fightResult->getIsCritical()) {
            $harm = intval($attackNum * $attack->getCriticalStrikeDamage() / 100);
        }
        //计算元素攻击
        if (!empty($attack->getAttackElement())) {
            $fightResult->setAttackElement($attack->getAttackElement());
            //元素伤害
            $fightResult->setElementHarm($attack->getElementNum($attack->getAttackElement()));
        }
        $fightResult->setHarmNum($harm);
    }

}
