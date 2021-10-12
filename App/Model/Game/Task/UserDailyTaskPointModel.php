<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * UserDailyTaskPointModel
 * Class UserDailyTaskPointModel
 * Create With ClassGeneration
 * @property int $userId // 用户id
 * @property int $weekPointNum // 每周积分数
 * @property int $dailyPointNum // 每日积分
 * @property int $lastUpdateTime // 上次更新时间
 */
class UserDailyTaskPointModel extends BaseModel
{
    protected $tableName = 'user_daily_task_point_list';


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


    public function addData(int $userId, int $weekPointNum, int $dailyPointNum, int $lastUpdateTime): self
    {
        $data = [
            'userId'         => $userId,
            'weekPointNum'   => $weekPointNum,
            'dailyPointNum'  => $dailyPointNum,
            'lastUpdateTime' => $lastUpdateTime,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }

    public function getInfo($userId)
    {
        $info = $this->where('userId', $userId)->get();
        if (empty($info)) {
            $info = $this->addData($userId, 0, 0, time());
        }
        return $info;
    }
}

