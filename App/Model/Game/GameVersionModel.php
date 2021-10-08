<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * GameVersionModel
 * Class GameVersionModel
 * Create With ClassGeneration
 * @property int $id //
 * @property int $versionId // 版本id
 * @property string $description // 版本介绍
 * @property int $addTime // 新增时间
 * @property string $url // 下载地址
 */
class GameVersionModel extends BaseModel
{
	protected $tableName = 'game_version_list';


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


	public function addData(int $versionId, string $description, int $addTime, string $url): self
	{
		$data = [
		    'versionId'=>$versionId,
		    'description'=>$description,
		    'addTime'=>$addTime,
		    'url'=>$url,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

