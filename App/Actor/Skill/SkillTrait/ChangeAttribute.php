<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Buff\BuffBean;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\FightEvent;
use App\Actor\Skill\Effect\ChangeProperty;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Utility\Str;

trait ChangeAttribute
{

    /**
     * 直接修改属性
     * effectHarm
     * @param Attribute $targetBaseAttribute
     * @param Attribute $targetAttribute
     * @param SkillBean $skillInfo
     * @param ChangeProperty      $effectBean
     * @return SkillEffectResult
     * @author tioncico
     * Time: 9:27 上午
     */
    public function effectChangeProperty(Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, ChangeProperty $effectBean)
    {
        $num = $this->evalRenderVariable($targetBaseAttribute,$targetAttribute,$skillInfo,$effectBean->getNumCount());
        $propertyName = $effectBean->getPropertyName();
        $skillEffectResult = new SkillEffectResult(['effectName' => $effectBean->getName(), 'effectType' => $effectBean->getType(), 'skillInfo' => $skillInfo]);
        $skillEffectResult->addPropertyChange($propertyName,$num);
        return $skillEffectResult;
    }

    public function changeAttribute(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        Logger::getInstance()->console("属性变动触发 {$effectResult->getEffectName()}");
        if ($effectResult->getEffectType() == 'harm') {
            $this->triggerBuckleBloodEventBefore($targetAttribute, $effectResult);
            $this->harm($targetAttribute, $effectResult);
            $this->triggerBuckleBloodEventAfter($targetAttribute, $effectResult);
        }else{
            var_dump($effectResult->getPropertyChangeList());
            foreach ($effectResult->getPropertyChangeList() as $propertyName=>$num){
                Logger::getInstance()->console("{$targetAttribute->getName()}{$propertyName}属性 +{$num}");
                $getMethodName = "get".Str::studly($propertyName);
                $setMethodName = "set".Str::studly($propertyName);
                $targetAttribute->$setMethodName($targetAttribute->$getMethodName()+$num);
            }
        }
    }

    public function harm(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        //扣除血量
        $buckleBloodNum = $effectResult->getBuckleBloodNum();
        Logger::getInstance()->console("实际扣血{$buckleBloodNum}  {$targetAttribute->getName()} hp:{$targetAttribute->getHp()}");
        if ($buckleBloodNum == 0) {
            return true;
        }
        $targetAttribute->incHp(-$buckleBloodNum);
    }

    public function triggerBuckleBloodEventBefore(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        /**
         * @var $event FightEvent
         */
        $event = $this->fight->getEvent();
        if ($targetAttribute->getAttributeType() == 1) {
            $event->userBuckleBloodBefore($targetAttribute, $effectResult);
        }
        if ($targetAttribute->getAttributeType() == 3) {
            $event->monsterBuckleBloodBefore($targetAttribute, $effectResult);
        }
    }

    public function triggerBuckleBloodEventAfter(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        /**
         * @var $event FightEvent
         */
        $event = $this->fight->getEvent();
        if ($targetAttribute->getAttributeType() == 1) {
            $event->userBuckleBloodAfter($targetAttribute, $effectResult);
        }
        if ($targetAttribute->getAttributeType() == 3) {
            $event->monsterBuckleBloodAfter($targetAttribute, $effectResult);
        }
    }
}
