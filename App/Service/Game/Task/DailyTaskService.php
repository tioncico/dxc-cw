<?php


namespace App\Service\Game\Task;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\Task\GameDailyTaskModel;
use App\Model\Game\Task\GameTaskModel;
use App\Model\Game\Task\GameTaskRewardModel;
use App\Model\Game\Task\UserDailyTaskCompleteModel;
use App\Model\Game\Task\UserDailyTaskPointModel;
use App\Model\Game\Task\UserDailyTaskReceiveModel;
use App\Model\Game\Task\UserGameTaskCompleteModel;
use App\Model\Game\Task\UserGameTaskMasterCompleteModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Service\BaseService;
use App\Service\Game\BackpackService;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Http\Message\Request;
use EasySwoole\Mysqli\QueryBuilder;
use function AlibabaCloud\Client\value;

class DailyTaskService extends BaseService
{
    use Singleton;

    public function handleTask(int $userId, ?Request $request = null)
    {
        //获取当天所有任务
        $model = new GameDailyTaskModel();
        $taskList = $model->with(['userCompleteInfo' => $userId], false)->all();
        /**
         * @var $task GameDailyTaskModel
         */
        foreach ($taskList as $task) {
            if ($task->maxNum <= ($task->userCompleteInfo->completeNum ?? 0)) {
                continue;
            }
            $method = "task{$task->code}";
            if (method_exists($this, $method)) {
                $checkResult = $this->$method($userId, $request);
                if ($checkResult === true) {
                    $this->completeTask($userId, $task);
                }
            }
        }
    }

    /**
     * 签到
     * task001
     * @param int          $userId
     * @param Request|null $request
     * @return bool
     * @author tioncico
     * Time: 4:47 下午
     */
    public function task001(int $userId, ?Request $request = null)
    {
        if (empty($request)) {
            return false;
        }
        if ($request->getUri()->getPath() == '/Api/User/Sign/userSign') {
            return true;
        }
        return false;
    }

    public function task003(int $userId, ?Request $request = null)
    {
        if (empty($request)) {
            return false;
        }
        if ($request->getUri()->getPath() == '/Api/User/UserEquipment/strengthen') {
            return true;
        }
        return false;
    }

    public function task006(int $userId, ?Request $request = null)
    {
        if (empty($request)) {
            return false;
        }
        if ($request->getUri()->getPath() == '/Api/User/ShopGoods/buy') {
            return true;
        }
        return false;
    }

    public function completeTask($userId, GameDailyTaskModel $taskInfo)
    {
        return BaseModel::transaction(function () use ($userId, $taskInfo) {
            //给自己加积分
            $model = new UserDailyTaskPointModel();
            $userPointNumInfo = $model->getInfo($userId);
            //判断是否已经到了最大数量
            $taskInfo = GameDailyTaskModel::create()->with(['userCompleteInfo' => $userId], false)->get($taskInfo->gameDailyTaskId);
            if ($taskInfo->maxNum <= ($taskInfo->userCompleteInfo->completeNum ?? 0)) {
                return null;
            }
            $userCompleteInfo = UserDailyTaskCompleteModel::create()->getTodayUserCompleteInfo($userId, $taskInfo->gameDailyTaskId);
            //新增完成记录
            $userCompleteInfo->update([
                'completeNum' => QueryBuilder::inc(1)
            ]);
            //新增积分
            $userPointNumInfo->update([
                'weekPointNum'  => QueryBuilder::inc($taskInfo->rewardPoint),
                'dailyPointNum' => QueryBuilder::inc($taskInfo->rewardPoint),
            ]);
        });
    }


}
