<?php


namespace App\Actor\Buff;


use App\Actor\Skill\SkillEffectResult;
use App\Actor\Skill\SkillList\Skill0003;
use App\Actor\Skill\SkillList\Skill0004;
use EasySwoole\EasySwoole\Logger;

class Buff001 extends BuffBean
{
    protected $buffName = "感电";
    protected $buffCode = '001';
    protected $isDeBuff = 1;
    protected $level = 1;
    protected $buffLayer = 1;
    protected $maxBuffLayer = 1;
    protected $triggerType = '51';
    protected $triggerRate = 100;
    protected $coolingTime;
    protected $description = "感电";
    protected $expireType = 1;
    protected $expireTime = 0;
    protected $isExpire = false;

    public function useBuff(SkillEffectResult $effectResult)
    {

    }
}
