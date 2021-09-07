<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * MapModel
 * Class MapModel
 * Create With ClassGeneration
 * @property int $mapId // 地图id
 * @property string $name // 地图名
 * @property int $mapEnvironmentId //所属环境id
 * @property int $difficultyLevel // 难度级别
 * @property string $description // 地图介绍
 * @property int $recommendedLevel // 建议等级
 * @property int $isInstanceZone // 是否为副本
 * @property int $maxLevel // 最大层数
 * @property int $monsterNum // 每层怪物最大数量
 * @property int $exp // 经验基数
 * @property int $gold // 金币基数
 * @property int $material // 材料基数
 * @property int $equipment // 装备基数
 * @property int $pet // 宠物基数
 * @property int $prop // 道具基数
 * @property int $order // 排序
 */
class MapModel extends BaseModel
{
	protected $tableName = 'map_list';


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

