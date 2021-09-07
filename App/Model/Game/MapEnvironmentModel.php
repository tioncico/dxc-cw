<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * MapEnvironmentModel
 * Class MapEnvironmentModel
 * Create With ClassGeneration
 * @property int $mapEnvironmentId // 环境id
 * @property string $name // 环境名
 * @property string $description // 环境介绍
 * @property string $recommendedLevelValue // 建议等级
 * @property int $isInstanceZone // 是否为副本
 */
class MapEnvironmentModel extends BaseModel
{
	protected $tableName = 'map_environment_list';


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

