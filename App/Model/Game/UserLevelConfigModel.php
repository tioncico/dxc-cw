<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserLevelConfigModel
 * Class UserLevelConfigModel
 * Create With ClassGeneration
 * @property int $level // 等级
 * @property int $exp // 所需经验
 */
class UserLevelConfigModel extends BaseModel
{
	protected $tableName = 'user_level_config';


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

