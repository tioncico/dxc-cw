<?php


namespace App\Actor\Buff\BuffTrait;


use App\Actor\Buff\BuffBean;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillBean;
use EasySwoole\EasySwoole\Logger;

trait TemplateHandle
{

    /**
     * 解析变量
     * renderVariable
     * @param SkillBean|null $skillInfo
     * @param                $str
     * @return string|string[]
     * @author tioncico
     * Time: 9:27 上午
     */
    public function renderVariable(?BuffBean $buffBean, $str)
    {
        $arr = $this->replaceVariableArr($buffBean);

        $str = str_replace(array_keys($arr), array_values($arr), $str);
        return $str;
    }

    public function evalRenderVariable(?BuffBean $buffBean, $str)
    {
        $str = $this->renderVariable($buffBean, $str);
        return eval("return {$str} ;");
    }

    /**
     * 替换变量数组
     * replaceVariableArr
     * @param Attribute|null $targetBaseAttribute
     * @param Attribute|null $targetAttribute
     * @param BuffBean|null  $buffBean
     * @return array
     * @author tioncico
     * Time: 9:26 上午
     */
    public function replaceVariableArr(?BuffBean $buffBean)
    {
        //获取到所有 {$xx} 包裹的数据
        $arr = [];
//        var_dump($this->attribute);
        foreach (['self' => $this->attribute, 'selfBase' => $this->baseAttribute,] as $field => $data) {
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
            '{$buffInfo.buffName}'     => $buffBean->getBuffName(),
            '{$buffInfo.buffCode}'     => $buffBean->getBuffCode(),
            '{$buffInfo.isDeBuff}'     => $buffBean->getIsDeBuff(),
            '{$buffInfo.level}'        => $buffBean->getLevel(),
            '{$buffInfo.buffLayer}'    => $buffBean->getBuffLayer(),
            '{$buffInfo.maxBuffLayer}' => $buffBean->getMaxBuffLayer(),
            '{$buffInfo.triggerType}'  => $buffBean->getTriggerType(),
            '{$buffInfo.triggerRate}'  => $buffBean->getTriggerRate(),
            '{$buffInfo.coolingTime}'  => $buffBean->getCoolingTime(),
            '{$buffInfo.description}'  => $buffBean->getDescription(),
            '{$buffInfo.expireType}'   => $buffBean->getExpireType(),
            '{$buffInfo.expireTime}'   => $buffBean->getExpireTime(),
            '{$buffInfo.isExpire}'     => $buffBean->isExpire(),
        ];
        $arr = array_merge($arr, $skillData);
        return $arr;

    }


}
