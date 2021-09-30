<?php

namespace App\Actor\Skill;

use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Actor\Skill\Effect\EffectBean;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillList\NormalAttack;
use EasySwoole\Utility\Str;

class SkillManager
{
    /**
     * @var SkillBean[][]
     */
    protected $skillList;
    /**
     * @var Attribute
     */
    protected $baseAttribute;//基础信息
    /**
     * @var Attribute
     */
    protected $attribute;//当前信息

    protected $attributeType;

    /**
     * @var Fight
     */
    protected $fight;

    const VARIABLE = [
        //释放技能人当前属性
        "self"      => [
            'hp',
            'mp',
            'level',
            'attack',
            'defense',
            'criticalRate',
            'criticalStrikeDamage',
            'hitRate',
            'dodgeRate',
            'penetrate',
            'attackSpeed',
            'userElement',
            'attackElement',
            'jin',
            'mu',
            'tu',
            'sui',
            'huo',
            'light',
            'dark',
            'luck',
        ],
        //释放技能人原有属性
        "selfBase"  => [
            'hp',
            'mp',
            'level',
            'attack',
            'defense',
            'criticalRate',
            'criticalStrikeDamage',
            'hitRate',
            'dodgeRate',
            'penetrate',
            'attackSpeed',
            'userElement',
            'attackElement',
            'jin',
            'mu',
            'tu',
            'sui',
            'huo',
            'light',
            'dark',
            'luck',
        ],
        //技能目标属性
        "enemy"     => [
            'hp',
            'mp',
            'level',
            'attack',
            'defense',
            'criticalRate',
            'criticalStrikeDamage',
            'hitRate',
            'dodgeRate',
            'penetrate',
            'attackSpeed',
            'userElement',
            'attackElement',
            'jin',
            'mu',
            'tu',
            'sui',
            'huo',
            'light',
            'dark',
            'luck',
        ],
        //技能目标原有属性
        "enemyBase" => [
            'hp',
            'mp',
            'level',
            'attack',
            'defense',
            'criticalRate',
            'criticalStrikeDamage',
            'hitRate',
            'dodgeRate',
            'penetrate',
            'attackSpeed',
            'userElement',
            'attackElement',
            'jin',
            'mu',
            'tu',
            'sui',
            'huo',
            'light',
            'dark',
            'luck',
        ],
        "skillInfo" => [
            "skillCode",
            "level",
            "triggerType",
            "triggerRate",
            "coolingTime",
            "manaCost",
            "tickTime",
        ]
    ];

    public function __construct(Attribute $baseAttribute, Attribute $attribute, Fight $fight)
    {
        $this->baseAttribute = $baseAttribute;
        $this->attribute = $attribute;
        $this->fight = $fight;
        $this->attributeType = $attribute->getAttributeType();
    }

    public function addSkill(SkillBean $skillBean)
    {
        $this->skillList[$skillBean->getTriggerType()][$skillBean->getSkillCode()] = $skillBean;
    }

    public function trigger($type, $code = null)
    {
        $skillResult = new SkillResult();
        //如果$code为null,则触发所有技能
        if ($code === null) {
            $skillList = $this->skillList[$type];
            foreach ($skillList as $skill) {
                $this->useSkill($skill, $skillResult);
            }
        } else {
            $skill = $this->skillList[$type][$code] ?? '';;
            if ($skill) {
                //使用技能
                $this->useSkill($skill, $skillResult);
            }
        }
    }

    public function useSkill(SkillBean $skill, SkillResult $skillResult)
    {
        //判断技能是否冷却
        if ($skill->getTickTime() > 0) {
            return false;
        }
        $this->onSkillBefore($skill);
        var_dump("{$this->attributeType} 触发技能{$skill->getSkillName()}");
        //获取$skill的属性
        $effectList = $skill->getEffectParam();
        foreach ($effectList as $effectBean) {
            $type = $effectBean->getType();
            list($targetBaseAttribute, $targetAttribute) = $this->getTargetAttribute($effectBean->getTarget());
            $methodName = 'effect' . Str::studly($type);
            $skillEffectResult = $this->$methodName($targetBaseAttribute, $targetAttribute, $skill, $effectBean);
            $skillResult->addEffectResult($skillEffectResult);
        }
        $this->coolSkill($skill);
        $this->onSkillAfter($skill);
    }

    protected function onSkillBefore(SkillBean $skill)
    {
        if ($skill instanceof NormalAttack){
            switch ($this->attributeType){
                case 1:
                    $this->fight->getEvent()->userNormalAttackBefore($this->attribute);
                    break;
                case 2:
                    $this->fight->getEvent()->petNormalAttackBefore($this->attribute);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterBuckleBloodBefore($this->attribute);
                    break;
            }
        }else{
            switch ($this->attributeType){
                case 1:
                    $this->fight->getEvent()->userSkillBefore($this->attribute,$skill);
                    break;
                case 2:
                    $this->fight->getEvent()->petSkillBefore($this->attribute,$skill);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterSkillBefore($this->attribute,$skill);
                    break;
            }
        }
    }

    protected function onSkillAfter(SkillBean $skill)
    {
        if ($skill instanceof NormalAttack){
            switch ($this->attributeType){
                case 1:
                    $this->fight->getEvent()->userNormalAttackAfter($this->attribute);
                    break;
                case 2:
                    $this->fight->getEvent()->petNormalAttackAfter($this->attribute);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterBuckleBloodAfter($this->attribute);
                    break;
            }
        }else{
            switch ($this->attributeType){
                case 1:
                    $this->fight->getEvent()->userSkillAfter($this->attribute,$skill);
                    break;
                case 2:
                    $this->fight->getEvent()->petSkillAfter($this->attribute,$skill);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterSkillAfter($this->attribute,$skill);
                    break;
            }
        }
    }

    public function coolSkill(SkillBean $skill)
    {
        $coolingTimeStr = $skill->getCoolingTime();
        $str = $this->renderVariable(null, null, $skill, $coolingTimeStr);
        $harmNum = eval("return {$str} ;");
        $skill->setTickTime($harmNum);
    }

    public function decCoolSkill($num)
    {
        foreach ($this->skillList as $skillCodeList) {
            foreach ($skillCodeList as $skill) {
                if ($skill->getTickTime() > 0) {
                    $skill->incTickTime(-$num);
                    if ($skill->getTickTime() <= 0) {
                        var_dump("{$skill->getSkillName()} 技能冷却完成");
                    }
                }
            }
        }
    }

    public function effectHarm(Attribute $targetBaseAttribute, Attribute $targetAttribute, SkillBean $skillInfo, Harm $effectBean)
    {
        $skillEffectResult = new SkillEffectResult();
        $elementStr = $this->renderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getElement());
        $element = eval("return {$elementStr} ;");
        $skillEffectResult->setAttackElement($element);
        $str = $this->renderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $effectBean->getCountStr());
        $harmNum = eval("return {$str} ;");
        if ($effectBean->getHarmType() == 'hp') {
            $skillEffectResult->setBuckleBloodNum($harmNum);
        } else {
            $skillEffectResult->setHarmNum($harmNum);
        }
        $skillEffectResult->setTargetType($this->getEffectTargetType($effectBean->getTarget()));
        return $skillEffectResult;
    }

    protected function getEffectTargetType($targetType)
    {
        if ($targetType == 'self') {
            return 0;
        }
        if ($targetType == 'user') {
            return 1;
        }
        if ($targetType == 'enemy') {
            if ($this->attribute->getAttributeType() == 3) {//怪物的敌人
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function renderVariable(?Attribute $targetBaseAttribute, ?Attribute $targetAttribute, ?SkillBean $skillInfo, $str)
    {
        $arr = $this->replaceVariableArr($targetBaseAttribute, $targetAttribute, $skillInfo);
        $str = str_replace(array_keys($arr), array_values($arr), $str);
        return $str;
    }

    public function replaceVariableArr(?Attribute $targetBaseAttribute, ?Attribute $targetAttribute, ?SkillBean $skillInfo)
    {
        //获取到所有 {$xx} 包裹的数据
        $arr = [];
        foreach (['self' => $this->attribute, 'enemy' => $targetAttribute, 'selfBase' => $this->baseAttribute, 'enemyBase' => $targetBaseAttribute] as $field => $data) {
            if (empty($data)) {
                continue;
            }
            $attributeArr = [
                "{\${$field}.hp}"                   => $data->getHp(),
                "{\${$field}.mp}"                   => $data->getMp(),
                "{\${$field}.level}"                => $data->getLevel(),
                "{\${$field}.attack}"               => $data->getAttack(),
                "{\${$field}.defense}"              => $data->getDefense(),
                "{\${$field}.criticalRate}"         => $data->getCriticalRate(),
                "{\${$field}.criticalStrikeDamage}" => $data->getCriticalStrikeDamage(),
                "{\${$field}.hitRate}"              => $data->getHitRate(),
                "{\${$field}.dodgeRate}"            => $data->getDodgeRate(),
                "{\${$field}.penetrate}"            => $data->getPenetrate(),
                "{\${$field}.attackSpeed}"          => $data->getAttackSpeed(),
                "{\${$field}.userElement}"          => $data->getUserElement(),
                "{\${$field}.attackElement}"        => $data->getAttackElement(),
                "{\${$field}.jin}"                  => $data->getJin(),
                "{\${$field}.mu}"                   => $data->getMu(),
                "{\${$field}.tu}"                   => $data->getTu(),
                "{\${$field}.sui}"                  => $data->getSui(),
                "{\${$field}.huo}"                  => $data->getHuo(),
                "{\${$field}.light}"                => $data->getLight(),
                "{\${$field}.dark}"                 => $data->getDark(),
                "{\${$field}.luck}"                 => $data->getLuck(),
            ];
            $arr = array_merge($arr, $attributeArr);
        }
        $skillData = [
            '{$skillInfo.skillCode}'   => $skillInfo->getSkillCode(),
            '{$skillInfo.level}'       => $skillInfo->getLevel(),
            '{$skillInfo.triggerType}' => $skillInfo->getTriggerType(),
            '{$skillInfo.triggerRate}' => $skillInfo->getTriggerRate(),
            '{$skillInfo.coolingTime}' => $skillInfo->getCoolingTime(),
            '{$skillInfo.manaCost}'    => $skillInfo->getManaCost(),
            '{$skillInfo.tickTime}'    => $skillInfo->getTickTime(),
        ];

        $arr = array_merge($arr, $skillData);
        return $arr;

    }

    protected function getTargetAttribute($targetType)
    {
        if ($targetType == 'self') {
            return [$this->baseAttribute, $this->attribute];
        }
        if ($targetType == 'user') {
            return [$this->fight->getUserBaseAttribute(), $this->fight->getUserAttribute()];
        }
        if ($targetType == 'enemy') {
            if ($this->attribute->getAttributeType() == 3) {//怪物的敌人
                return [$this->fight->getUserBaseAttribute(), $this->fight->getUserAttribute()];
            } else {
                return [$this->fight->getMonsterBaseAttribute(), $this->fight->getMonsterAttribute()];//玩家和宠物的敌人
            }
        }
    }

}
