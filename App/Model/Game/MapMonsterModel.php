<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * MapMonsterModel
 * Class MapMonsterModel
 * Create With ClassGeneration
 * @property int    $mapMonsterId //
 * @property int    $monsterId // 怪物id
 * @property int    $mapId // 地图id
 * @property int    $mapLevelMin // 地图关卡最小
 * @property int    $mapLevelMax // 地图关卡最大
 * @property string $name // 怪物名称
 * @property int    $type // 怪物类型 1小怪,2精英,3boss
 * @property string $description // 怪物介绍
 * @property int    $level // 怪物等级
 * @property int    $hp // 血量
 * @property int    $mp // 法力
 * @property int    $attack // 攻击力
 * @property int    $defense // 防御力
 * @property int    $endurance // 耐力
 * @property int    $intellect // 智力
 * @property int    $strength // 力量
 * @property int    $enduranceQualification // 耐力资质
 * @property int    $intellectQualification // 智力资质
 * @property int    $strengthQualification // 力量资质
 * @property int    $criticalRate // 暴击率
 * @property int    $criticalStrikeDamage // 暴击伤害
 * @property int    $hitRate // 命中率
 * @property int    $dodgeRate // 闪避率
 * @property int    $penetrate // 穿透力
 * @property int    $attackSpeed // 攻击速度
 * @property int    $userElement // 角色元素
 * @property int    $attackElement // 攻击元素
 * @property int    $jin // 金
 * @property int    $mu // 木
 * @property int    $tu // 土
 * @property int    $sui // 水
 * @property int    $huo // 火
 * @property int    $light // 光
 * @property int    $dark // 暗
 */
class MapMonsterModel extends BaseModel
{
    protected $tableName = 'map_monster_list';


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
            'page'      => $page,
            'pageSize'  => $pageSize,
            'list'      => $list,
            'total'     => $total,
            'pageCount' => ceil($total / $pageSize)
        ];
        return $data;
    }

    public function addData(MapModel $mapInfo, MonsterModel $monsterInfo, $mapLevelMin, $mapLevelMax)
    {
        $data = [
            'monsterId'              => $monsterInfo->monsterId,
            'mapId'                  => $mapInfo->mapId,
            'mapLevelMin'            => $mapLevelMin,
            'mapLevelMax'            => $mapLevelMax,
            'name'                   => $monsterInfo->name,
            'type'                   => $monsterInfo->type,
            'description'            => $monsterInfo->description,
            'level'                  => $monsterInfo->level,
            'hp'                     => $monsterInfo->hp,
            'mp'                     => $monsterInfo->mp,
            'attack'                 => $monsterInfo->attack,
            'defense'                => $monsterInfo->defense,
            'endurance'              => $monsterInfo->endurance,
            'intellect'              => $monsterInfo->intellect,
            'strength'               => $monsterInfo->strength,
            'enduranceQualification' => $monsterInfo->enduranceQualification,
            'intellectQualification' => $monsterInfo->intellectQualification,
            'strengthQualification'  => $monsterInfo->strengthQualification,
            'criticalRate'           => $monsterInfo->criticalRate,
            'criticalStrikeDamage'   => $monsterInfo->criticalStrikeDamage,
            'hitRate'                => $monsterInfo->hitRate,
            'dodgeRate'              => $monsterInfo->dodgeRate,
            'penetrate'              => $monsterInfo->penetrate,
            'attackSpeed'            => $monsterInfo->attackSpeed,
            'userElement'            => $monsterInfo->userElement,
            'attackElement'          => $monsterInfo->attackElement,
            'jin'                    => $monsterInfo->jin,
            'mu'                     => $monsterInfo->mu,
            'tu'                     => $monsterInfo->tu,
            'sui'                    => $monsterInfo->sui,
            'huo'                    => $monsterInfo->huo,
            'light'                  => $monsterInfo->light,
            'dark'                   => $monsterInfo->dark,
        ];
        $model = new MapMonsterModel($data);
        $model->save();
        return $model;
    }
}

