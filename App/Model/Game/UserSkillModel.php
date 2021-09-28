<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserSkillModel
 * Class UserSkillModel
 * Create With ClassGeneration
 * @property int    $userSkillId // 玩家技能id
 * @property int    $userId // 玩家id
 * @property int    $skillId // 技能id
 * @property string $skillName // 技能名
 * @property int    $isUse // 是否穿戴
 * @property int    $level // 技能等级
 * @property int    $type //  触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发
 * @property int    $rarityLevel // 稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话
 * @property int    $maxLevel // 最大等级
 * @property int    $coolingTime // 冷却时间
 * @property int    $manaCostQualification // 耗蓝资质
 * @property string $entryCode // 词条code
 * @property string $description // 介绍
 * @property string $param // 参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字
 * @property string $qualification // 技能资质,json数组,例如词条为:攻击力增加1,那每升一级攻击力+参数
 * @property int    $manaCost // 耗蓝
 */
class UserSkillModel extends BaseModel
{
    protected $tableName = 'user_skill_list';

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

    public function addData($userId, SkillModel $skillInfo)
    {
        $data = [
            'userId'                => $userId,
            'skillId'               => $skillInfo->skillId,
            'skillName'             => $skillInfo->name,
            'isUse'                 => 0,
            'level'                 => $skillInfo->level,
            'type'                  => $skillInfo->type,
            'rarityLevel'           => $skillInfo->rarityLevel,
            'maxLevel'              => $skillInfo->maxLevel,
            'coolingTime'           => $skillInfo->coolingTime,
            'manaCostQualification' => $skillInfo->manaCostQualification,
            'entryCode'             => $skillInfo->entryCode,
            'description'           => $skillInfo->description,
            'param'                 => $skillInfo->param,
            'qualification'         => $skillInfo->qualification,
            'manaCost'              => $skillInfo->manaCost,
        ];
        $model = new UserSkillModel($data);
        $model->save();
    }
}

