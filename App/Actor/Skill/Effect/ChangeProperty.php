<?php


namespace App\Actor\Skill\Effect;


class ChangeProperty extends EffectBean
{
    protected $type = "changeProperty";
    protected $name = "修改属性";
    protected $numCount = "数量算法";
    protected $propertyName = 'hp';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

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
