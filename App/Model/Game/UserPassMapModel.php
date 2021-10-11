<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserPassMapModel
 * Class UserPassMapModel
 * Create With ClassGeneration
 * @property int $userPassMapId //
 * @property int $userId // 用户id
 * @property int $mapId // 地图id
 * @property int $mapEnvironmentId // 环境id
 * @property string $difficultyLevel // 难度
 * @property mixed $addTime // 通关时间
 */
class UserPassMapModel extends BaseModel
{
	protected $tableName = 'user_pass_map_list';


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


	public function addData(int $userId, int $mapId, int $mapEnvironmentId, string $difficultyLevel, mixed $addTime): self
	{
		$data = [
		    'userId'=>$userId,
		    'mapId'=>$mapId,
		    'mapEnvironmentId'=>$mapEnvironmentId,
		    'difficultyLevel'=>$difficultyLevel,
		    'addTime'=>$addTime,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

