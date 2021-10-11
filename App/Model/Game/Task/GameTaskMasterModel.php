<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * GameTaskMasterModel
 * Class GameTaskMasterModel
 * Create With ClassGeneration
 * @property int    $taskMasterId // 主任务id
 * @property string $type // 1 主线任务
 * @property string $name // 任务名
 * @property string $description // 任务介绍
 * @property int    $order // 排序
 *
 * @property UserGameTaskMasterCompleteModel $userTaskCompleteInfo
 */
class GameTaskMasterModel extends BaseModel
{
    protected $tableName = 'game_task_master_list';


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


    public function addData(string $type, string $name, string $description, int $order): self
    {
        $data = [
            'type'        => $type,
            'name'        => $name,
            'description' => $description,
            'order'       => $order,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }


    public function taskList()
    {
        return $this->hasMany(GameTaskModel::class, function (QueryBuilder $query) {
            $query->orderBy('`order`', 'ASC');
            $query->join("game_task_reward_list", "game_task_reward_list.taskId=game_task_list.taskId", "left");
            $query->join("goods_list", "goods_list.code=game_task_reward_list.goodsCode", "left");
            return $query;
        }, 'taskMasterId', 'taskMasterId');
    }

    public function userTaskCompleteInfo($userId=-1)
    {
        if($userId<=0){
            return  null;
        }
        return $this->hasOne(UserGameTaskMasterCompleteModel::class, function (QueryBuilder $query) use ($userId) {
            $query->where('userId', $userId);
            return $query;
        }, 'taskMasterId', 'taskMasterId');
    }

}

