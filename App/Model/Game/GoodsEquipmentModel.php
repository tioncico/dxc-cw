<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * GoodsEquipmentModel
 * Class GoodsEquipmentModel
 * Create With ClassGeneration
 * @property string $goodsCode // 物品code
 * @property int $equipmentType // 装备类型 1武器 2帽子 3衣服 4裤子 5鞋子 6披风  7称号 8项链 9戒指
 * @property string $goodsName // 装备名
 * @property string $description // 装备介绍
 * @property string $attributeDescription // 属性介绍
 * @property string $attributeEntryDescription // 随机属性介绍
 * @property string $extraAttributeDescription // 额外词条属性介绍
 * @property string $suitAttribute2Description // 套装2属性词条介绍
 * @property string $suitAttribute3Description // 套装3属性词条介绍
 * @property string $suitAttribute5Description // 套装5属性词条介绍
 * @property string $suitCode // 套装code
 * @property int $strengthenLevel // 强化等级
 * @property int $rarityLevel // 稀有度
 * @property int $level // 装备等级
 * @property int $hp // 血量
 * @property int $mp // 法力值
 * @property int $attack // 攻击力
 * @property int $defense // 防御力
 * @property int $endurance // 耐力
 * @property int $intellect // 智力
 * @property int $strength // 力量
 * @property int $criticalRate // 暴击率
 * @property int $criticalStrikeDamage // 暴击伤害
 * @property int $hitRate // 命中率
 * @property int $dodgeRate // 闪避率
 * @property int $penetrate // 穿透
 * @property int $attackSpeed // 攻击速度
 * @property int $userElement // 角色元素
 * @property int $attackElement // 攻击元素
 * @property int $jin // 金
 * @property int $mu // 木
 * @property int $tu // 土
 * @property int $sui // 水
 * @property int $huo // 火
 * @property int $light // 光
 * @property int $dark // 暗
 * @property int $luck // 幸运值
 */
class GoodsEquipmentModel extends BaseModel
{
	protected $tableName = 'goods_equipment_list';


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

