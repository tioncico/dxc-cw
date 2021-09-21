<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserPetModel
 * Class UserPetModel
 * Create With ClassGeneration
 * @property int $userPetId //
 * @property int $petId //
 * @property int $userId // 用户id
 * @property string $name // 宠物名称
 * @property string $type // 宠物类型 1金2木3土4水5火6光7暗
 * @property int $isUse // 是否携带宠物
 * @property string $description // 怪物介绍
 * @property int $level // 怪物等级
 * @property int $classLevel // 宠物阶级
 * @property int $exp // 怪物经验
 * @property int $isBest // 是否为极品宠物
 * @property int $hp // 血量
 * @property int $mp // 法力
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
 * @property int $dodgeRate // 闪避率
 * @property int $penetrate // 穿透力
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
 */
class UserPetModel extends BaseModel
{
	protected $tableName = 'user_pet_list';


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


	public function addData(
		int $petId,
		int $userId,
		string $name,
		string $type,
		int $isUse,
		string $description,
		int $level,
		int $exp,
		int $isBest,
		int $hp,
		int $mp,
		int $attack,
		int $defense,
		int $endurance,
		int $intellect,
		int $strength,
		int $enduranceQualification,
		int $intellectQualification,
		int $strengthQualification,
		int $criticalRate,
		int $criticalStrikeDamage,
		int $hitRate,
		int $dodgeRate,
		int $penetrate,
		int $attackSpeed,
		int $userElement,
		int $attackElement,
		int $jin,
		int $mu,
		int $tu,
		int $sui,
		int $huo,
		int $light,
		int $dark
	): self {
		$data = [
		    'petId'=>$petId,
		    'userId'=>$userId,
		    'name'=>$name,
		    'type'=>$type,
		    'isUse'=>$isUse,
		    'description'=>$description,
		    'level'=>$level,
		    'exp'=>$exp,
		    'isBest'=>$isBest,
		    'hp'=>$hp,
		    'mp'=>$mp,
		    'attack'=>$attack,
		    'defense'=>$defense,
		    'endurance'=>$endurance,
		    'intellect'=>$intellect,
		    'strength'=>$strength,
		    'enduranceQualification'=>$enduranceQualification,
		    'intellectQualification'=>$intellectQualification,
		    'strengthQualification'=>$strengthQualification,
		    'criticalRate'=>$criticalRate,
		    'criticalStrikeDamage'=>$criticalStrikeDamage,
		    'hitRate'=>$hitRate,
		    'dodgeRate'=>$dodgeRate,
		    'penetrate'=>$penetrate,
		    'attackSpeed'=>$attackSpeed,
		    'userElement'=>$userElement,
		    'attackElement'=>$attackElement,
		    'jin'=>$jin,
		    'mu'=>$mu,
		    'tu'=>$tu,
		    'sui'=>$sui,
		    'huo'=>$huo,
		    'light'=>$light,
		    'dark'=>$dark,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

