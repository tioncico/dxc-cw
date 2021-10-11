<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * UserGameTaskMasterCompleteModel
 * Class UserGameTaskMasterCompleteModel
 * Create With ClassGeneration
 * @property int $id // 用户id
 * @property int $userId // 用户id
 * @property int $taskMasterId // 主任务id
 * @property int $nowTaskId // 当前任务id
 */
class UserGameTaskMasterCompleteModel extends BaseModel
{
    protected $tableName = 'user_game_task_master_complete_list';


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


    public function addData(int $userId, int $taskMasterId, int $nowTaskId): self
    {
        $data = [
            'userId'       => $userId,
            'taskMasterId' => $taskMasterId,
            'nowTaskId'    => $nowTaskId,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }

    public function getInfo($userId, $taskMasterId)
    {
        $info = $this->where('userId', $userId)->where('taskMasterId', $taskMasterId)->get();
        if (empty($info)) {
            $info = $this->addData($userId, $taskMasterId, 0);
        }
        return $info;
    }
}

