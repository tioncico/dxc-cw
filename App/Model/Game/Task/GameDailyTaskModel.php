<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * GameDailyTaskModel
 * Class GameDailyTaskModel
 * Create With ClassGeneration
 * @property int    $gameDailyTaskId // 游戏每日任务id
 * @property string $name // 任务名
 * @property string $code // 任务code
 * @property string $description // 任务介绍
 * @property int    $rewardPoint // 奖励积分
 * @property int    $maxNum // 总奖励次数限制
 *
 * @property UserDailyTaskCompleteModel $userCompleteInfo
 */
class GameDailyTaskModel extends BaseModel
{
    protected $tableName = 'game_daily_task_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): array
    {
        $list = $this
            ->withTotalCount()
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->page($page, $pageSize)
            ->all();
        $total = $this->lastQueryResult()->getTotalCount();
        $data = [
            'page'      => $page,
            'pageSize'  => $pageSize,
            'list'      => $list,
            'total'     => $total,
            'pageCount' => ceil($total / $pageSize)
        ];
        return $data;
    }


    public function addData(string $name, string $code, string $description, int $rewardPoint, int $maxNum): self
    {
        $data = [
            'name'        => $name,
            'code'        => $code,
            'description' => $description,
            'rewardPoint' => $rewardPoint,
            'maxNum'      => $maxNum,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }

    public function userCompleteInfo($userId=-1)
    {
        if ($userId<=0){
            return  null;
        }
        return $this->hasOne(UserDailyTaskCompleteModel::class, function (QueryBuilder $query)use($userId) {
            $query->where('userId',$userId);
            $query->where('date',date('Ymd'));
            return $query;
        }, 'gameDailyTaskId', 'gameDailyTaskId');
    }
}

