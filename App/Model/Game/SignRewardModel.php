<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * SignRewardModel
 * Class SignRewardModel
 * Create With ClassGeneration
 * @property int $id //
 * @property int $signNum // 签到天数
 * @property int $money // 奖励钻石
 */
class SignRewardModel extends BaseModel
{
	protected $tableName = 'sign_reward_list';


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
}

