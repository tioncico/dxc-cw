<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * UserSkillModel
 * Class UserSkillModel
 * Create With ClassGeneration
 * @property int    $userSkillId // 玩家技能id
 * @property int    $userId // 玩家id
 * @property int    $skillId // 技能id
 * @property string $skillName // 技能名
 * @property int    $triggerType //  触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发
 * @property string $triggerRate // 触发概率计算
 * @property int    $isUse // 是否穿戴
 * @property int    $level // 技能等级
 * @property int    $rarityLevel // 稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话
 * @property int    $maxLevel // 最大等级
 * @property string $coolingTime // 冷却时间
 * @property string $manaCost // 耗蓝
 * @property string $entryCode // 词条code
 * @property string $description // 介绍
 * @property string $effectParam // 参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字
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


    public function addData(int $userId, SkillModel $skillModel): self
    {
        $data = [
            'userId'      => $userId,
            'skillId'     => $skillModel->skillId,
            'skillName'   => $skillModel->name,
            'triggerType' => $skillModel->triggerType,
            'triggerRate' => $skillModel->triggerRate,
            'isUse'       => 0,
            'level'       => 0,
            'rarityLevel' => $skillModel->rarityLevel,
            'maxLevel'    => $skillModel->maxLevel,
            'coolingTime' => $skillModel->coolingTime,
            'manaCost'    => $skillModel->manaCost,
            'entryCode'   => $skillModel->entryCode,
            'description' => $skillModel->description,
            'effectParam' => $skillModel->effectParam,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }

    public function getUserSkillByCode($userId, SkillModel $skillModel)
    {
        $info = $this->where('userId', $userId)->where('skillId', $skillModel->skillId)->get();
        if (empty($info)) {
            $info = $this->addData($userId, $skillModel);
        }
        return $info;
    }

    public function levelUp($userId, SkillModel $skillModel){
        $info = $this->getUserSkillByCode($userId,$skillModel);
        if ($info->maxLevel>$info->level){
            $info->update(['level'=>QueryBuilder::inc(1)]);
        }
        return $info;
    }
}

