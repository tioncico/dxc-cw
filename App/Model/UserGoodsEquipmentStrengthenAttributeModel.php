<?php

namespace App\Model;

/**
 * UserGoodsEquipmentStrengthenAttributeModel
 * Class UserGoodsEquipmentStrengthenAttributeModel
 * Create With ClassGeneration
 * @property int $userEquipmentBackpackId // 用户装备id
 * @property int $strengthenLevel // 强化等级
 * @property int $hp // 血量
 * @property int $attack // 攻击
 * @property int $defense // 防御
 */
class UserGoodsEquipmentStrengthenAttributeModel extends BaseModel
{
	protected $tableName = 'user_goods_equipment_strengthen_attribute_list';


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

