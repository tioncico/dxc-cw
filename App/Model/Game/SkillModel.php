<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * SkillModel
 * Class SkillModel
 * Create With ClassGeneration
 * @property int $skillId // 技能id
 * @property string $name // 技能名
 * @property int $level // 技能初始等级
 * @property int $type //  触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发
 * @property int $rarityLevel // 技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话
 * @property int $maxLevel // 最大等级
 * @property int $coolingTime // 冷却时间
 * @property int $manaCost // 耗蓝
 * @property string $entryCode // 词条code
 * @property string $description // 技能介绍
 * @property string $param // 参数
 * @property string $qualification // 资质参数
 * @property int $manaCostQualification // 耗蓝资质
 */
class SkillModel extends BaseModel
{
	protected $tableName = 'skill_list';


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

