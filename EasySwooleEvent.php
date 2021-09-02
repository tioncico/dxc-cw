<?php


namespace EasySwoole\EasySwoole;


use App\Utility\GlobalEvent;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\EasySwoole\Swoole\EventRegister;

class EasySwooleEvent implements Event
{
    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');
        GlobalEvent::getInstance()->initialize();
    }

    public static function mainServerCreate(EventRegister $register)
    {
        GlobalEvent::getInstance()->mainServerCreate($register);
    }
}
