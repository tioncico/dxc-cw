<?php


namespace App\Crontab;


use App\Model\Game\Task\UserDailyTaskPointModel;
use App\Model\Game\UserAttributeModel;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\EasySwoole\Trigger;

class User extends AbstractCronTask
{
    public static function getRule(): string
    {
        return "0 0 * * *";
    }

    public static function getTaskName(): string
    {
        return "user";
    }

    function run(int $taskId, int $workerIndex)
    {
        $this->refresh();
    }

    function refresh()
    {
        //更新体力
        UserAttributeModel::create()->update(['physicalStrength'=>200],[],true);
        //更新积分
        UserDailyTaskPointModel::create()->update(['dailyPointNum'=>0,'lastUpdateTime'=>time()],[],true);
        //如果今天星期日
        if (date("w")==0){
            UserDailyTaskPointModel::create()->update(['weekPointNum'=>0,'lastUpdateTime'=>time()],[],true);
        }
    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        Trigger::getInstance()->throwable($throwable);
    }


}
