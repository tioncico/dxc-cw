<?php


namespace App\Utility;


use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\Component\Timer;
use EasySwoole\EasySwoole\Logger;
use Swoole\Coroutine;

class TickProcess extends AbstractProcess
{
    protected $taskList = [];
    protected $isRun = false;

    public function __construct(...$args)
    {
        parent::__construct(...$args);
    }

    protected function run($arg)
    {
        $this->isRun = true;
        foreach ($this->taskList as $tickTime => $taskArray) {
            if ($tickTime == 0) {
                //如果为0,则执行一次,兼容从->pop拿数据的任务
                Timer::getInstance()->after(1, function () use ($taskArray) {
                    foreach ($taskArray as $task) {
                        $this->runCoroutine($task);
                    }
                });
            } else {
                Timer::getInstance()->loop($tickTime * 1000, function () use ($taskArray) {
                    foreach ($taskArray as $task) {
                        $this->runCoroutine($task);
                    }
                });
            }
        }
    }

    function setTaskLists($tickTime, array $taskLists = [])
    {
        if ($this->isRun) {
            return false;
        }
        $this->taskList[$tickTime] = $taskLists;
    }

    function addTask($tickTime, callable $task)
    {
        if ($this->isRun) {
            return false;
        }
        $this->taskList[$tickTime][] = $task;
    }

    protected function runCoroutine(callable $callable)
    {
        Coroutine::create(function () use ($callable) {
            try {
                call_user_func($callable);
            } catch (\Throwable $throwable) {
                //不做异常通知
                Logger::getInstance()->error($throwable->getMessage());
            }
        });
    }

    function onException(\Throwable $throwable, ...$args)
    {
        Logger::getInstance()->error($throwable->__toString());
    }

}
