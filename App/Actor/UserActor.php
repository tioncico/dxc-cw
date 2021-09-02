<?php


namespace App\Actor;


use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;

class UserActor extends AbstractActor
{
    public static function configure(ActorConfig $actorConfig)
    {
        $actorConfig->setActorName('userActor');
        $actorConfig->setWorkerNum(3);
    }

    protected function onStart()
    {
        $actorId = $this->actorId();
        echo "Player Actor {$actorId} onStart\n";
    }

    protected function onMessage($msg)
    {
        $actorId = $this->actorId();
        echo "Player Actor {$actorId} onMessage\n";
    }

    protected function onExit($arg)
    {
        $actorId = $this->actorId();
        echo "Player Actor {$actorId} onExit\n";
    }

    protected function onException(\Throwable $throwable)
    {
        $actorId = $this->actorId();
        echo "Player Actor {$actorId} onException\n";
    }


}
