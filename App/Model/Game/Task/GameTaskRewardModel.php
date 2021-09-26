<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * GameTaskRewardModel
 * Class GameTaskRewardModel
 * Create With ClassGeneration
 * @property int $taskRewardId // 奖励id
 * @property int $taskId // 任务id
 * @property string $goodsCode // 物品code
 * @property int $num // 数量
 */
class GameTaskRewardModel extends BaseModel
{
	protected $tableName = 'game_task_reward_list';


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
		    'page'=>$page,
		    'pageSize'=>$pageSize,
		    'list'=>$list,
		    'total'=>$total,
		    'pageCount'=>ceil($total / $pageSize)
		];
		return $data;
	}


	public function addData(int $taskId, string $goodsCode, int $num): self
	{
		$data = [
		    'taskId'=>$taskId,
		    'goodsCode'=>$goodsCode,
		    'num'=>$num,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

