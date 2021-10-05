<?php

namespace App\Actor\Skill\Effect;


use App\Actor\Buff\Buff001;
use App\Service\Game\Attribute;

/**
 * 技能效果[造成伤害,如果是携带其他buff效果,额外增加伤害]
 * Class Harm
 * @package App\Service\Game\Skill\Effect
 */
class Effect001 extends Harm
{
    protected $type = 'effect001';

    protected $addMultipleNum;

    protected $buffType = 51;

    protected $buffCode = '001';

    /**
     * @return mixed
     */
    public function getAddMultipleNum()
    {
        return $this->addMultipleNum;
    }

    /**
     * @param mixed $addMultipleNum
     */
    public function setAddMultipleNum($addMultipleNum): void
    {
        $this->addMultipleNum = $addMultipleNum;
    }

    /**
     * @return int
     */
    public function getBuffType(): int
    {
        return $this->buffType;
    }

    /**
     * @param int $buffType
     */
    public function setBuffType(int $buffType): void
    {
        $this->buffType = $buffType;
    }

    /**
     * @return string
     */
    public function getBuffCode(): string
    {
        return $this->buffCode;
    }

    /**
     * @param string $buffCode
     */
    public function setBuffCode(string $buffCode): void
    {
        $this->buffCode = $buffCode;
    }




}
