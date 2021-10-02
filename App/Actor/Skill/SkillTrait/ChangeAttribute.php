<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillEffectResult;
use EasySwoole\EasySwoole\Logger;

trait ChangeAttribute
{
    public function changeAttribute(Attribute $targetAttribute, SkillEffectResult $effectResult)
    {
        Logger::getInstance()->console("属性变动触发");
        if ($effectResult->getEffectType()=='harm'){
            $this->harm($targetAttribute,$effectResult);
        }
    }

    public function harm(Attribute $targetAttribute, SkillEffectResult $effectResult){
        //扣除血量
        $buckleBloodNum = $effectResult->getBuckleBloodNum();
        $targetAttribute->incHp(-$buckleBloodNum);
        Logger::getInstance()->console("真正扣血{$buckleBloodNum}  {$targetAttribute->getName()} hp:{$targetAttribute->getHp()}");
    }
}
