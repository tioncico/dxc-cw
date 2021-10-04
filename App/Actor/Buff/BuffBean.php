<?php


namespace App\Actor\Buff;


use App\Actor\Skill\Effect\EffectBean;

class BuffBean
{
    protected $buffName;//buff 名
    protected $buffCode;//buff code
    protected $isDeBuff = 1;
    protected $level;//buff等级
    protected $buffLayer; //buff层数
    protected $maxBuffLayer; //最大buff层数
    protected $triggerType;//触发类型
    protected $triggerRate;//触发概率
    protected $coolingTime;//冷却时间计算
    protected $description;//介绍
    protected $expireType = 1;//1正常倒计时过期(战斗完直接失效) 2正常倒计时过期(退出地图直接失效) 3正常倒计时过期(一直有效)
    protected $expireTime = 0;//倒计时(秒)
    protected $isExpire = false;//是否过期
    /**
     * @var EffectBean[]
     */
    protected $effectParam = [];//效果数组

    /**
     * @return mixed
     */
    public function getBuffName()
    {
        return $this->buffName;
    }

    /**
     * @param mixed $buffName
     */
    public function setBuffName($buffName): void
    {
        $this->buffName = $buffName;
    }

    /**
     * @return mixed
     */
    public function getBuffCode()
    {
        return $this->buffCode;
    }

    /**
     * @param mixed $buffCode
     */
    public function setBuffCode($buffCode): void
    {
        $this->buffCode = $buffCode;
    }

    /**
     * @return int
     */
    public function getIsDeBuff(): int
    {
        return $this->isDeBuff;
    }

    /**
     * @param int $isDeBuff
     */
    public function setIsDeBuff(int $isDeBuff): void
    {
        $this->isDeBuff = $isDeBuff;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getBuffLayer()
    {
        return $this->buffLayer;
    }

    /**
     * @param mixed $buffLayer
     */
    public function setBuffLayer($buffLayer): void
    {
        $this->buffLayer = $buffLayer;
    }

    /**
     * @param mixed $buffLayer
     */
    public function incBuffLayer($buffLayer): void
    {
        $this->buffLayer += $buffLayer;
    }

    /**
     * @return mixed
     */
    public function getMaxBuffLayer()
    {
        return $this->maxBuffLayer;
    }

    /**
     * @param mixed $maxBuffLayer
     */
    public function setMaxBuffLayer($maxBuffLayer): void
    {
        $this->maxBuffLayer = $maxBuffLayer;
    }

    /**
     * @return mixed
     */
    public function getTriggerType()
    {
        return $this->triggerType;
    }

    /**
     * @param mixed $triggerType
     */
    public function setTriggerType($triggerType): void
    {
        $this->triggerType = $triggerType;
    }

    /**
     * @return mixed
     */
    public function getTriggerRate()
    {
        return $this->triggerRate;
    }

    /**
     * @param mixed $triggerRate
     */
    public function setTriggerRate($triggerRate): void
    {
        $this->triggerRate = $triggerRate;
    }

    /**
     * @return mixed
     */
    public function getCoolingTime()
    {
        return $this->coolingTime;
    }

    /**
     * @param mixed $coolingTime
     */
    public function setCoolingTime($coolingTime): void
    {
        $this->coolingTime = $coolingTime;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getExpireType(): int
    {
        return $this->expireType;
    }

    /**
     * @param int $expireType
     */
    public function setExpireType(int $expireType): void
    {
        $this->expireType = $expireType;
    }

    /**
     * @return int
     */
    public function getExpireTime(): int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime): void
    {
        $this->expireTime = $expireTime;
    }

    /**
     * @return bool
     */
    public function isExpire(): bool
    {
        return $this->isExpire;
    }

    /**
     * @param bool $isExpire
     */
    public function setIsExpire(bool $isExpire): void
    {
        $this->isExpire = $isExpire;
    }

    /**
     * @return EffectBean[]
     */
    public function getEffectParam(): array
    {
        return $this->effectParam;
    }

    /**
     * @param EffectBean[] $effectParam
     */
    public function setEffectParam(array $effectParam): void
    {
        $this->effectParam = $effectParam;
    }

}
