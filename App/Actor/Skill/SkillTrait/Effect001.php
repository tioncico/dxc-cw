<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Buff\BuffBean;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\FightEvent;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait Effect001
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
    public function effectEffect001(Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, \App\Actor\Skill\Effect\Effect001 $effectBean)
    {
        $skillEffectResult = new SkillEffectResult(['effectName' => $effectBean->getName(), 'effectType' => $effectBean->getType(), 'skillInfo' => $skillInfo]);
        $element = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getElement());
        $skillEffectResult->setAttackElement($element);
        $harmNum = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getCountStr());
        Logger::getInstance()->console("初始伤害 {$harmNum}");
        //判断是否暴击
        if ($effectBean->getIsCritical()) {
            $criticalRate = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getCriticalRate());
            if (mt_rand(1, 100) <= $criticalRate) {
                Logger::getInstance()->console("暴击");
                $skillEffectResult->setIsCritical(1);
                $criticalRateHarm = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getCriticalStrikeDamage());
                $harmNum = intval($harmNum * $criticalRateHarm / 100);
            }
        }

        //判断是否存在某buff效果
        $buff = $targetAttribute->getBuffManager()->getBuffInfo($effectBean->getBuffCode());
        if ($buff instanceof BuffBean) {
            $num = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getAddMultipleNum());
            $harmNum = intval($num / 100 * $harmNum);
        }

        if ($effectBean->getHarmType() == 'hp') {
            $bloodNum = $harmNum;
        } else {
            //进行扣血算法
            $bloodNum = $this->buckleBloodCount($harmNum, $targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean);
        }
        $skillEffectResult->setHarmNum($harmNum);
        $skillEffectResult->setBuckleBloodNum($bloodNum);
        $skillEffectResult->setTargetType($this->getEffectTargetType($effectBean->getTarget()));
        return $skillEffectResult;
    }


}
