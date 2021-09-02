<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserJoinMapModel
 * Class UserJoinMapModel
 * Create With ClassGeneration
 * @property int $userId // 用户id
 * @property int $mapId // 当前地图id
 * @property string $nowLevel // 当前地图层数
 */
class UserJoinMapModel extends BaseModel
{
	protected $tableName = 'user_join_map_list';


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

