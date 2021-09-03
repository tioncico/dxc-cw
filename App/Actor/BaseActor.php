<?php


namespace App\Actor;


use EasySwoole\Actor\AbstractActor;

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
        echo "mapActor {$actorId} onException\n";
    }

}
