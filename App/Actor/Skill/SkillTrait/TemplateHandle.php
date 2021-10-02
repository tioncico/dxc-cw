<?php


namespace App\Actor\Skill\SkillTrait;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillBean;

trait TemplateHandle
{

    /**
     * 解析变量
     * renderVariable
     * @param Attribute|null $targetBaseAttribute
     * @param Attribute|null $targetAttribute
     * @param SkillBean|null $skillInfo
     * @param                $str
     * @return string|string[]
     * @author tioncico
     * Time: 9:27 上午
     */
    public function renderVariable(?Attribute $targetBaseAttribute, ?Attribute $targetAttribute, ?SkillBean $skillInfo, $str)
    {
        $arr = $this->replaceVariableArr($targetBaseAttribute, $targetAttribute, $skillInfo);
        $str = str_replace(array_keys($arr), array_values($arr), $str);
        return $str;
    }

    public function evalRenderVariable(?Attribute $targetBaseAttribute, ?Attribute $targetAttribute, ?SkillBean $skillInfo, $str)
    {
        $str = $this->renderVariable($targetBaseAttribute, $targetAttribute, $skillInfo, $str);
        return eval("return {$str} ;");
    }

    /**
     * 替换变量数组
     * replaceVariableArr
     * @param Attribute|null $targetBaseAttribute
     * @param Attribute|null $targetAttribute
     * @param SkillBean|null $skillInfo
     * @return array
     * @author tioncico
     * Time: 9:26 上午
     */
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


}
