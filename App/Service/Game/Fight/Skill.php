<?php


namespace App\Service\Game\Fight;


use App\Model\Game\BuffModel;
use App\Service\Game\Attribute;
use App\Service\Game\Buff;
use App\Service\Game\SkillAttribute;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;
use function AlibabaCloud\Client\value;
use function Stringy\create;

class Skill
{

    public static function useSkill(Attribute $attackAttribute, Attribute $beAttackAttribute, SkillAttribute $skillAttribute, FightResult $fightResult)
    {
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
        $harm = $harm + $num + intval($harm * $paramData[1] / 100);
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

    /**
     * 雷霆一击,增加感电buff
     * entry0002
     * @param Attribute      $attack
     * @param Attribute      $beAttack
     * @param SkillAttribute $skillAttribute
     * @param FightResult    $fightResult
     * @author tioncico
     * Time: 8:15 下午
     */
    public static function entry0002(Attribute $attack, Attribute $beAttack, SkillAttribute $skillAttribute, FightResult $fightResult)
    {
        $paramData = json_decode($skillAttribute->getParam(), true);
        //第一个参数为基础伤害,第二个为百分比
        $num = $paramData[0] ?? 0;
        //伤害计算
        $attackNum = $attack->getAttack();
        $harm = $attackNum;
        //技能额外增加伤害
        $harm = $harm + $num + intval($harm * $paramData[1] / 100);
        //增加感电buff
        $buffCode = "0001";
        $buffInfo = BuffModel::create()->get(['code' => $buffCode]);
        if ($buffInfo) {
            $buff = new Buff($buffInfo->toArray());
            $buff->setExpireTime(time() + 1000);//5秒过期
            //给敌人施加debuff
            $beAttack->addBuff($buff);
        }

        $fightResult->setHarmNum($harm);
    }

    /**
     * 雷霆万钧,感电buff额外增加上海
     * entry0003
     * @param Attribute      $attack
     * @param Attribute      $beAttack
     * @param SkillAttribute $skillAttribute
     * @param FightResult    $fightResult
     * @author tioncico
     * Time: 8:15 下午
     */
    public static function entry0003(Attribute $attack, Attribute $beAttack, SkillAttribute $skillAttribute, FightResult $fightResult)
    {
        $paramData = json_decode($skillAttribute->getParam(), true);
        //第一个参数为基础伤害,第二个为百分比
        $num = $paramData[0] ?? 0;
        //伤害计算
        $attackNum = $attack->getAttack();
        $harm = $attackNum;
        //技能额外增加伤害
        $harm = $harm + $num + intval($harm * $paramData[1] / 100);
        //获取敌人的感电buff
        $buffInfo = $beAttack->getBuffByTypeAndCode(10, "0001");
        if ($buffInfo) {
            $harm = $harm + intval($harm * 100 / 100);
        }

        $fightResult->setHarmNum($harm);
    }

}
