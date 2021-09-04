<?php


namespace App\Utility\Rand;


use EasySwoole\Spl\SplBean;

class Bean extends SplBean
{
    protected $odds = 0;
    protected $isCommon = false;
    protected $value = null;

    /**
     * @return int
     */
    public function getOdds(): int
    {
        return $this->odds;
    }

    /**
     * @param int $odds
     */
    public function setOdds(int $odds): void
    {
        $this->odds = $odds;
    }

    /**
     * @return bool
     */
    public function isCommon(): bool
    {
        return $this->isCommon;
    }

    /**
     * @param bool $isCommon
     */
    public function setIsCommon(bool $isCommon): void
    {
        $this->isCommon = $isCommon;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

}
