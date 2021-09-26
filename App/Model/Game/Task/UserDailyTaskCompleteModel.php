<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * UserDailyTaskCompleteModel
 * Class UserDailyTaskCompleteModel
 * Create With ClassGeneration
 * @property int $userDailyTaskCompleteId //
 * @property int $userId //
 * @property int $gameDailyTaskId //
 * @property int $completeNum //
 * @property int $date //
 * @property int $addTime //
 */
class UserDailyTaskCompleteModel extends BaseModel
{
	protected $tableName = 'user_daily_task_complete_list';


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


	public function addData(int $userId, int $gameDailyTaskId, int $completeNum, int $date, int $addTime): self
	{
		$data = [
		    'userId'=>$userId,
		    'gameDailyTaskId'=>$gameDailyTaskId,
		    'completeNum'=>$completeNum,
		    'date'=>$date,
		    'addTime'=>$addTime,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

