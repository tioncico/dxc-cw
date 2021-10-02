<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait EffectHarm
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
    public function effectHarm(Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, Harm $effectBean)
    {
        $skillEffectResult = new SkillEffectResult(['effectName'=>$effectBean->getName(),'effectType'=>$effectBean->getType()]);
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

    public function buckleBloodCount(int $harmNum, Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, Harm $effectBean)
    {
        //伤害计算 伤害-(对方防御率*1-($自身穿透率));
        $element = $this->evalRenderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getElement());
        /**
         * @var Attribute  $this->attribute
         */
        if ($element > 0) {
            $harmNum = $harmNum - ($targetAttribute->getDefense() * (100 - $this->attribute->getPenetrate()) / 100);
        } else {
            $harmNum = $harmNum - ($targetAttribute->getDefense() * (100 - $this->attribute->getPenetrate()) / 100);
        }
        if ($harmNum<=0){
            $harmNum=1;
        }

        Logger::getInstance()->console("扣血计算{$harmNum}");
        return $harmNum;
    }
}
