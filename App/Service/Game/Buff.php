<?php


namespace App\Service\Game;


use EasySwoole\Spl\SplBean;

class Buff extends SplBean
{
    protected $name;
    protected $code;
    protected $stackLayer;
    protected $entryCode;
    protected $param;
    protected $type;// 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发
    protected $description;

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


}
