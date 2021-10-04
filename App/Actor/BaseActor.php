<?php


namespace App\Actor;


use EasySwoole\Actor\AbstractActor;
use EasySwoole\EasySwoole\Trigger;

abstract class BaseActor extends AbstractActor
{

    /**
     * onMessage
     * @param $msg Command
     * @author tioncico
     * Time: 3:27 下午
     */
    protected function onMessage($msg)
    {
        $actorId = $this->actorId();
        echo "mapActor {$actorId} onMessage\n";
        $actionName = $msg->getAction();
        if ($actionName == 'getProperty') {
            $propertyName = $msg->getData();
            return $this->$propertyName;
        }
        if ($actionName == 'setProperty') {
            $propertyName = $msg->getData()['propertyName'];
            return $this->$propertyName = $msg->getData()['data'];
        }

        return $this->$actionName($msg->getData());
    }

    protected function onExit($arg)
    {
        $actorId = $this->actorId();
        echo "mapActor {$actorId} onExit\n";
    }

    protected function onException(\Throwable $throwable)
    {
        $actorId = $this->actorId();
        Trigger::getInstance()->throwable($throwable);
        echo "mapActor {$actorId} onException\n";
    }

    public static function sendAction($actorId, $action, $data)
    {
        return static::client()->send($actorId, new Command(['action' => $action, 'data' => $data]));
    }

}
