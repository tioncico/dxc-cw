<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;
use App\Service\Game\SkillAttribute;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;

class Skill
{

    public static function useSkill(Attribute $attackAttribute, Attribute $beAttackAttribute, SkillAttribute $skillAttribute, FightResult $fightResult){
        $entryCode = $skillAttribute->getEntryCode();
        $actionName = 'entry' . Str::studly($entryCode);
        Skill::$actionName($attackAttribute, $beAttackAttribute, $skillAttribute, $fightResult);
    }

    /**
     * 造成xx+xx%伤害
     * entry3001
     * @param Attribute      $attack
     * @param Attribute      $beAttack
     * @param SkillAttribute $skillAttribute
     * @author tioncico
     * Time: 7:27 下午
     */
    public static function entry0001(Attribute $attack, Attribute $beAttack, SkillAttribute $skillAttribute, FightResult $fightResult)
    {
        $paramData = json_decode($skillAttribute->getParam(), true);
        //第一个参数为基础伤害,第二个为百分比
        $num = $paramData[0] ?? 0;
        //伤害计算
        //可能暴击
        $attackNum = $attack->getAttack();
        $harm = $attackNum;
        //技能额外增加伤害
        $harm = $harm + $num + intval($harm *  $paramData[1]  / 100);
        var_dump($harm,$num,$paramData[1]);
        if ($fightResult->getIsCritical()) {
            $harm = intval($attackNum * $attack->getCriticalStrikeDamage() / 100);
        }
        //计算元素攻击
        if (!empty($attack->getAttackElement())) {
            $fightResult->setAttackElement($attack->getAttackElement());
            //元素伤害
            $fightResult->setElementHarm($attack->getElementNum($attack->getAttackElement()));
        }
        var_dump($harm);
        $fightResult->setHarmNum($harm);
    }

}
