<?php

namespace App\Actor\Goods;

use EasySwoole\Spl\SplBean;

class GoodsResult extends SplBean
{
    protected $goodsInfo;
    protected $effectType = "";//效果类型
    protected $targetModel = null;//目标模型数据
    protected $effectName = "";//效果名称
    protected $targetType = 0;//0自身,1玩家,2怪物
    protected $harmNum = 0;//初始伤害
    protected $buckleBloodNum = 0;//强制扣血
    protected $isCritical = 0;//是否暴击
    protected $buffList = [];//附带buff
    protected $propertyChangeList = [];//元素变更情况,例如mp-10
    protected $tickTime=0;//冷却时间


    /**
     * @return mixed
     */
    public function getGoodsInfo()
    {
        return $this->goodsInfo;
    }

    /**
     * @param mixed $goodsInfo
     */
    public function setGoodsInfo($goodsInfo): void
    {
        $this->goodsInfo = $goodsInfo;
    }

    /**
     * @return string
     */
    public function getEffectType(): string
    {
        return $this->effectType;
    }

    /**
     * @param string $effectType
     */
    public function setEffectType(string $effectType): void
    {
        $this->effectType = $effectType;
    }

    /**
     * @return null
     */
    public function getTargetModel()
    {
        return $this->targetModel;
    }

    /**
     * @param null $targetModel
     */
    public function setTargetModel($targetModel): void
    {
        $this->targetModel = $targetModel;
    }

    /**
     * @return string
     */
    public function getEffectName(): string
    {
        return $this->effectName;
    }

    /**
     * @param string $effectName
     */
    public function setEffectName(string $effectName): void
    {
        $this->effectName = $effectName;
    }

    /**
     * @return int
     */
    public function getTargetType(): int
    {
        return $this->targetType;
    }

    /**
     * @param int $targetType
     */
    public function setTargetType(int $targetType): void
    {
        $this->targetType = $targetType;
    }

    /**
     * @return int
     */
    public function getHarmNum(): int
    {
        return $this->harmNum;
    }

    /**
     * @param int $harmNum
     */
    public function setHarmNum(int $harmNum): void
    {
        $this->harmNum = $harmNum;
    }

    /**
     * @return int
     */
    public function getBuckleBloodNum(): int
    {
        return $this->buckleBloodNum;
    }

    /**
     * @param int $buckleBloodNum
     */
    public function setBuckleBloodNum(int $buckleBloodNum): void
    {
        $this->buckleBloodNum = $buckleBloodNum;
    }

    /**
     * @return int
     */
    public function getIsCritical(): int
    {
        return $this->isCritical;
    }

    /**
     * @param int $isCritical
     */
    public function setIsCritical(int $isCritical): void
    {
        $this->isCritical = $isCritical;
    }

    /**
     * @return array
     */
    public function getBuffList(): array
    {
        return $this->buffList;
    }

    /**
     * @param array $buffList
     */
    public function setBuffList(array $buffList): void
    {
        $this->buffList = $buffList;
    }

    /**
     * @return array
     */
    public function getPropertyChangeList(): array
    {
        return $this->propertyChangeList;
    }

    /**
     * @param array $propertyChangeList
     */
    public function setPropertyChangeList(array $propertyChangeList): void
    {
        $this->propertyChangeList = $propertyChangeList;
    }

    /**
     * @return int
     */
    public function getTickTime(): int
    {
        return $this->tickTime;
    }

    /**
     * @param int $tickTime
     */
    public function setTickTime(int $tickTime): void
    {
        $this->tickTime = $tickTime;
    }

}
