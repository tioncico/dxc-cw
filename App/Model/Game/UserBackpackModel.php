<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserBackpackModel
 * Class UserBackpackModel
 * Create With ClassGeneration
 * @property int $backpackId // 背包id
 * @property int $userId // 用户id
 * @property int $goodsId // 物品id
 * @property string $goodsCode // 物品code
 * @property int $num // 数量
 * @property int $goodsType // 物品类型
 */
class UserBackpackModel extends BaseModel
{
	protected $tableName = 'user_backpack_list';


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

