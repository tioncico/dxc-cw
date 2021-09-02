<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * AttributeEntryModel
 * Class AttributeEntryModel
 * Create With ClassGeneration
 * @property int $entryId // 词条id
 * @property string $code // 词条code
 * @property string $description // 介绍
 */
class AttributeEntryModel extends BaseModel
{
	protected $tableName = 'attribute_entry_list';


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

