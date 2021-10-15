<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * GameTaskModel
 * Class GameTaskModel
 * Create With ClassGeneration
 * @property int    $taskId // 任务id
 * @property int    $taskMasterId // 主任务id
 * @property string $code // 任务编码
 * @property int    $order // 排序
 * @property int    $completeNum // 完成次数
 * @property string $name // 任务名
 * @property string $description // 任务介绍
 * @property string $param // 任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]
 */
class GameTaskModel extends BaseModel
{
    protected $tableName = 'game_task_list';


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

    public function getParamAttr($value,$data){
        return json_decode($value,1);
    }


    public function addData(
        int $taskMasterId,
        string $code,
        int $order,
        int $completeNum,
        string $name,
        string $description,
        string $param
    ): self
    {
        $data = [
            'taskMasterId' => $taskMasterId,
            'code'         => $code,
            'order'        => $order,
            'completeNum'  => $completeNum,
            'name'         => $name,
            'description'  => $description,
            'param'        => $param,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }

    public function goodsList()
    {
        return $this->hasMany(GameTaskRewardModel::class, function (QueryBuilder $query) {
            $query->fields("goods_list.*,game_task_reward_list.num,game_task_reward_list.taskId");
            $query->join('goods_list', 'goods_list.code = game_task_reward_list.goodsCode');
            return $query;
        }, 'taskId', 'taskId');
    }
}

