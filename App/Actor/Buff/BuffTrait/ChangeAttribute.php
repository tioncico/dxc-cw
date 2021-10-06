<?php


namespace App\Actor\Buff\BuffTrait;


use App\Actor\Buff\BuffBean;
use App\Actor\Buff\BuffResult\BuffResult;
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
    public function changeAttribute(BuffResult $buffResult)
    {
        Logger::getInstance()->console("属性变动触发 {$buffResult->getBuffInfo()->getBuffName()}");
        foreach ($buffResult->getPropertyChangeList() as $propertyName => $num) {
            $getMethodName = "get" . Str::studly($propertyName);
            $setMethodName = "set" . Str::studly($propertyName);
            Logger::getInstance()->console("{$this->attribute->getName()}{$propertyName}属性:{$this->attribute->$getMethodName()}");
            $this->attribute->$setMethodName($this->attribute->$getMethodName() + $num);
            Logger::getInstance()->console("{$this->attribute->getName()}{$propertyName}现在属性:{$this->attribute->$getMethodName()}");
        }
    }
}
