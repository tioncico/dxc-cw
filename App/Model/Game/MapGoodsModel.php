<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * MapGoodsModel
 * Class MapGoodsModel
 * Create With ClassGeneration
 * @property int $mapGoodsId //
 * @property int $mapId // 地图id
 * @property string $goodsCode // 物品id
 * @property int $goodsType // 物品类型
 * @property int $odds // 爆率
 */
class MapGoodsModel extends BaseModel
{
	protected $tableName = 'map_goods_list';


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

