<?php


namespace App\Actor\Buff;


use App\Actor\Skill\SkillEffectResult;
use App\Actor\Skill\SkillList\Skill0003;
use App\Actor\Skill\SkillList\Skill0004;
use EasySwoole\EasySwoole\Logger;

class Buff002 extends BuffBean
{
    protected $buffName = "每秒回复xx属性";
    protected $buffCode = '002';
    protected $isDeBuff = 0;
    protected $level = 1;
    protected $buffLayer = 1;
    protected $maxBuffLayer = 1;
    protected $triggerType = '80';//一秒触发一次
    protected $triggerRate = 100;
    protected $coolingTime = 0;
    protected $description = "每秒回复xx属性";
    protected $expireType = 1;
    protected $expireTime = 0;
    protected $isExpire = false;
    protected $numCount = "数量算法";//数量算法
    protected $propertyName = 'hp';//属性名称

    /**
     * @return string
     */
    public function getNumCount(): string
    {
        return $this->numCount;
    }

    /**
     * @param string $numCount
     */
    public function setNumCount(string $numCount): void
    {
        $this->numCount = $numCount;
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @param string $propertyName
     */
    public function setPropertyName(string $propertyName): void
    {
        $this->propertyName = $propertyName;
    }


}
