<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\Task\GameTaskModel;
use App\Model\Game\Task\GameTaskRewardModel;
use App\Model\Game\Task\UserDailyTaskReceiveModel;
use App\Model\Game\Task\UserGameTaskCompleteModel;
use App\Model\Game\Task\UserGameTaskMasterCompleteModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserLevelConfigModel;
use App\Service\BaseService;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Mysqli\QueryBuilder;

class TaskService extends BaseService
{
    use Singleton;

    public function completeTask($userId, GameTaskModel $gameTaskInfo)
    {
        //验证有没有完成过,领取过奖品
        $this->checkTaskReceive($userId, $gameTaskInfo);
        //验证这个任务有没有完成
        $checkMethod = "checkTask" . $gameTaskInfo->code;
        $this->$checkMethod($userId, $gameTaskInfo);
        //验证任务进度
        $userTaskMasterInfo = UserGameTaskMasterCompleteModel::create()->getInfo($userId, $gameTaskInfo->taskMasterId);

        BaseModel::transaction(function () use ($userId, $gameTaskInfo, $userTaskMasterInfo) {
            //发放奖品
            $this->receive($userId, $gameTaskInfo);
            //更新任务为已完成
            UserGameTaskCompleteModel::create()->addData($userId, $gameTaskInfo->taskId, $gameTaskInfo->code, 1, 1, 2);
            //更新当前玩家任务进度
            $userTaskMasterInfo->update(['nowTaskId' => $gameTaskInfo->taskId]);
        });
        return $userTaskMasterInfo;
    }

    protected function receive($userId, GameTaskModel $gameTaskInfo)
    {
        //获取奖品数据
        $gameRewardList = GameTaskRewardModel::create()->with(['goodsInfo'])->where('taskId', $gameTaskInfo->taskId)->all();
        if (empty($gameRewardList)) {
            return true;
        }
        /**
         * @var $gameReward GameTaskRewardModel
         */
        foreach ($gameRewardList as  $gameReward){
            BackpackService::getInstance()->addGoods($userId, $gameReward->goodsInfo, $gameReward->num);
        }
    }

    protected function checkTaskReceive($userId, GameTaskModel $gameTaskInfo)
    {
        $info = UserGameTaskCompleteModel::create()->where('userId', $userId)->where('taskId', $gameTaskInfo->taskId)->get();
        if (empty($info)) {
            return true;
        }
        Assert::assert($info->state != 2, "该任务已经完成");
    }

    protected function checkTask001($userId, GameTaskModel $gameTaskInfo)
    {


    }

}
