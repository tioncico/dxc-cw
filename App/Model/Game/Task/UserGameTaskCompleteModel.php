<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * UserGameTaskCompleteModel
 * Class UserGameTaskCompleteModel
 * Create With ClassGeneration
 * @property int $userTaskCompleteId // 玩家任务完成id
 * @property int $userId // 玩家id
 * @property int $taskId // 任务id
 * @property string $taskCode // 任务code
 * @property int $nowNum // 当前数量
 * @property int $completeNum // 完成进度
 * @property int $state // 0未完成 1已完成 2已领取
 */
class UserGameTaskCompleteModel extends BaseModel
{
	protected $tableName = 'user_game_task_complete_list';


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


	public function addData(int $userId, int $taskId, string $taskCode, int $nowNum, int $completeNum, int $state): self
	{
		$data = [
		    'userId'=>$userId,
		    'taskId'=>$taskId,
		    'taskCode'=>$taskCode,
		    'nowNum'=>$nowNum,
		    'completeNum'=>$completeNum,
		    'state'=>$state,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

