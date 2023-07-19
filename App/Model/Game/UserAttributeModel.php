<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Utility\Random;

/**
 * UserAttributeModel
 * Class UserAttributeModel
 * Create With ClassGeneration
 * @property int $userId //
 * @property int $level // 等级
 * @property int $name // 游戏名
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

	public function addData($userId,$name=null){
        $data = [
            'userId'=>$userId,
            'level'=>1,
            'name'=>$name??"玩家".Random::character(10),
            'exp'=>0,
            'hp'=>100,
            'mp'=>100,
            'attack'=>10,
            'defense'=>0,
            'endurance'=>0,
            'intellect'=>0,
            'strength'=>0,
            'enduranceQualification'=>1,
            'intellectQualification'=>1,
            'strengthQualification'=>1,
            'criticalRate'=>0,
            'criticalStrikeDamage'=>200,
            'hitRate'=>50,
            'dodgeRate'=>0,
            'penetrate'=>0,
            'attackSpeed'=>0.5,
            'userElement'=>0,
            'attackElement'=>0,
            'jin'=>0,
            'mu'=>0,
            'tu'=>0,
            'sui'=>0,
            'huo'=>0,
            'light'=>0,
            'dark'=>0,
            'luck'=>0,
            'physicalStrength'=>100,
        ];
        $model = new UserAttributeModel($data);
        $model->save();
    }

    public function getInfo($userId){
	    $info = self::create()->get($userId);
	    if (empty($info)){
	        $info = $this->addData($userId);
        }
	    return $info;
    }
}

