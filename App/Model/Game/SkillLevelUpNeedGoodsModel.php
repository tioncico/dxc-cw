<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * SkillLevelUpNeedGoodsModel
 * Class SkillLevelUpNeedGoodsModel
 * Create With ClassGeneration
 * @property int $id // id
 * @property int $skillId // 技能id
 * @property int $level // 学习等级
 * @property string $goodsCode // 物品code
 * @property int $goodsNum // 物品数量
 */
class SkillLevelUpNeedGoodsModel extends BaseModel
{
	protected $tableName = 'skill_level_up_need_goods_list';


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


	public function addData(int $skillId, int $level, string $goodsCode, int $goodsNum): self
	{
		$data = [
		    'skillId'=>$skillId,
		    'level'=>$level,
		    'goodsCode'=>$goodsCode,
		    'goodsNum'=>$goodsNum,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

