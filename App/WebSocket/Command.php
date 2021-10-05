<?php


namespace App\WebSocket;


use EasySwoole\Spl\SplBean;

/**
 * 命令发送
 * Class Command
 * @package App\WebSocket
 */
class Command extends SplBean
{
    protected $action;
    protected $requestId;
    protected $code;
    protected $data;
    protected $msg;

    const SC_ACTION_GAME_INFO = 'gameInfo';
    const SC_ACTION_ERROR = 'error';

    const SC_ACTION_BOX_OPEN = 'boxOpen';
    const SC_ACTION_FIGHT = 'fightStart';
    const SC_ACTION_SKILL = 'fightSkill';
    const SC_ACTION_HARM = 'fightHarm';
    const SC_ACTION_USER_DIE = 'userDie';
    const SC_ACTION_MONSTER_DIE = 'monsterDie';
    const SC_ACTION_PROPERTY_CHANGE = 'property';
    const SC_ACTION_GOODS_CHANGE = 'goodsChange';
    const SC_ACTION_BUFF_CHANGE = 'buffChange';
    const SC_ACTION_FIGHT_END = 'fightEnd';


    const CS_EXIT_MAP = 'exitMap';
    const CS_FIGHT = 'fight';

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param mixed $requestId
     */
    public function setRequestId($requestId): void
    {
        $this->requestId = $requestId;
    }


}
