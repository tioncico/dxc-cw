<?php


namespace App\Service\Game;


use EasySwoole\Spl\SplBean;

class Buff extends SplBean
{
    protected $name;
    protected $isDeBuff;
    protected $code;
    protected $stackLayer=1;
    protected $nowStackLayer=1;
    protected $entryCode;
    protected $param;
    protected $type;
    protected $description;
    protected $expireType;//1正常倒计时过期(战斗完直接失效) 2正常倒计时过期(退出地图直接失效) 3正常倒计时过期(一直有效)
    protected $expireTime;//倒计时(秒)
    protected $isExpire=false;//是否过期

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIsDeBuff()
    {
        return $this->isDeBuff;
    }

    /**
     * @param mixed $isDeBuff
     */
    public function setIsDeBuff($isDeBuff): void
    {
        $this->isDeBuff = $isDeBuff;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getStackLayer()
    {
        return $this->stackLayer;
    }

    /**
     * @param mixed $stackLayer
     */
    public function setStackLayer($stackLayer): void
    {
        $this->stackLayer = $stackLayer;
    }

    /**
     * @return mixed
     */
    public function getEntryCode()
    {
        return $this->entryCode;
    }

    /**
     * @param mixed $entryCode
     */
    public function setEntryCode($entryCode): void
    {
        $this->entryCode = $entryCode;
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     */
    public function setParam($param): void
    {
        $this->param = $param;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
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
     * @return mixed
     */
    public function getExpireType()
    {
        return $this->expireType;
    }

    /**
     * @param mixed $expireType
     */
    public function setExpireType($expireType): void
    {
        $this->expireType = $expireType;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * @param mixed $expireTime
     */
    public function setExpireTime(int $expireTime): void
    {
        $this->expireTime = $expireTime;
    }

    public function incExpireTime(int $expireTime){
        $this->expireTime+=$expireTime;
    }

    /**
     * @return mixed
     */
    public function getNowStackLayer()
    {
        return $this->nowStackLayer;
    }

    /**
     * @param mixed $nowStackLayer
     */
    public function setNowStackLayer($nowStackLayer): void
    {
        $this->nowStackLayer = $nowStackLayer;
    }

    public function incNowStackLayer(int $nowStackLayer){
        $this->nowStackLayer += $nowStackLayer;
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


}
