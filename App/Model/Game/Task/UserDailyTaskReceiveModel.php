<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;

/**
 * UserDailyTaskReceiveModel
 * Class UserDailyTaskReceiveModel
 * Create With ClassGeneration
 * @property int $userDailyTaskReceiveId // 玩家每日任务领取id
 * @property int $userId // 玩家id
 * @property int $rewardId // 奖励id
 * @property int $addTime // 新增时间
 * @property int $date // 领取日期
 */
class UserDailyTaskReceiveModel extends BaseModel
{
	protected $tableName = 'user_daily_task_receive_list';


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


	public function addData(int $userId, int $rewardId, int $addTime, int $date): self
	{
		$data = [
		    'userId'=>$userId,
		    'rewardId'=>$rewardId,
		    'addTime'=>$addTime,
		    'date'=>$date,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

