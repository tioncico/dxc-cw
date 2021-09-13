<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * GoodsEquipmentAttributeEntryModel
 * Class GoodsEquipmentAttributeEntryModel
 * Create With ClassGeneration
 * @property string $code // 词条code
 * @property string $name // 词条名
 * @property int $equipmentEntryType // 装备词条类型 0通用 1防具 2武器 3首饰 4称号
 * @property string $baseCode // 基础词条code
 * @property int $level // 词条等级  1普通,2精致,3稀有,4罕见,5传说 词条
 * @property string $description // 介绍
 * @property string $param // 参数
 * @property int $odds // 随机概率
 */
class GoodsEquipmentAttributeEntryModel extends BaseModel
{
	protected $tableName = 'goods_equipment_attribute_entry_list';


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

