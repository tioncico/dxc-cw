<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserAttributeModel
 * Class UserAttributeModel
 * Create With ClassGeneration
 * @property int $userId //
 * @property int $level // 等级
 * @property int $exp // 经验
 * @property int $hp // 血量
 * @property int $mp // 法力值
 * @property int $attack // 攻击力
 * @property int $defense // 防御力
 * @property int $endurance // 耐力
 * @property int $intellect // 智力
 * @property int $strength // 力量
 * @property int $enduranceQualification // 耐力资质
 * @property int $intellectQualification // 智力资质
 * @property int $strengthQualification // 力量资质
 * @property int $criticalRate // 暴击率
 * @property int $criticalStrikeDamage // 暴击伤害
 * @property int $hitRate // 命中率
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
 * @property int $physicalStrength // 体力
 */
class UserAttributeModel extends BaseModel
{
	protected $tableName = 'user_attribute_list';


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

