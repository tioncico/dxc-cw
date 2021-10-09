<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * SkillShopModel
 * Class SkillShopModel
 * Create With ClassGeneration
 * @property int $skillShopId // id
 * @property int $skillId // 技能id
 * @property string $skillName // 技能名
 */
class SkillShopModel extends BaseModel
{
	protected $tableName = 'skill_shop_list';


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


	public function addData(int $skillId, string $skillName): self
	{
		$data = [
		    'skillId'=>$skillId,
		    'skillName'=>$skillName,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

