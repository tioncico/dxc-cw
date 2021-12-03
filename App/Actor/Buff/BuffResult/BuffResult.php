<?php


namespace App\Actor\Buff\BuffResult;


use App\Actor\Buff\BuffBean;
use EasySwoole\Spl\SplBean;

class BuffResult extends SplBean
{
    protected $buffInfo = null;//buff信息
    protected $propertyChangeList = [];//元素变更情况,例如mp-10
    protected $targetId = null;//目标模型数据

    /**
     * @return null
     */
    public function getBuffInfo():BuffBean
    {
        return $this->buffInfo;
    }

    /**
     * @param null $buffInfo
     */
    public function setBuffInfo($buffInfo): void
    {
        $this->buffInfo = $buffInfo;
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

    public function addPropertyChange($propertyName, $num)
    {
        if (isset($this->propertyChangeList[$propertyName])) {
            $this->propertyChangeList[$propertyName] += $num;
        } else {
            $this->propertyChangeList[$propertyName] = $num;
        }
    }

    /**
     * @return null
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     * @param
     */
    public function setTargetId($targetId): void
    {
        $this->targetId = $targetId;
    }

}
