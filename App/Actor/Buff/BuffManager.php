<?php

namespace App\Actor\Buff;

use App\Actor\Buff\BuffTrait\BuffTrait;
use App\Actor\Buff\BuffTrait\ChangeAttribute;
use App\Actor\Buff\BuffTrait\TemplateHandle;
use App\Actor\Fight\Bean\Attribute;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Utility\Str;

class BuffManager
{
    use BuffTrait;
    use TemplateHandle;
    use ChangeAttribute;

    /**
     * @var BuffBean[][]
     */
    protected $buffList = [];

    protected $buffCodeList = [];

    /**
     * @var Attribute
     */
    protected $baseAttribute;//基础信息
    /**
     * @var Attribute
     */
    protected $attribute;//当前信息

    protected $attributeType;

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

    public function __construct(Attribute $baseAttribute, Attribute $attribute)
    {
        $this->baseAttribute = $baseAttribute;
        $this->attribute = $attribute;
        $this->attributeType = $attribute->getAttributeType();
    }

    public function addBuff(BuffBean $buffBean, int $layer = 1)
    {
        //判断是否存在该buff并且没有过期
        $oldBuffInfo = $this->buffList[$buffBean->getTriggerType()][$buffBean->getBuffCode()] ?? null;
        if ($oldBuffInfo) {
            //没有过期,则判断是否可以叠加层数
            if ($oldBuffInfo->getMaxBuffLayer() > 1 && $oldBuffInfo->getBuffLayer() < $oldBuffInfo->getMaxBuffLayer()) {
                $oldBuffInfo->incBuffLayer($layer);
            }
            //刷新过期时间
            $oldBuffInfo->setExpireTime($buffBean->getExpireTime());
            $this->buffCodeList[$oldBuffInfo->getBuffCode()] = $oldBuffInfo;
        } else {
            $this->buffList[$buffBean->getTriggerType()][$buffBean->getBuffCode()] = $buffBean;
            $this->buffCodeList[$buffBean->getBuffCode()] = $buffBean;
        }
    }

    public function trigger($type, $code = null, ?SkillEffectResult $effectResult = null)
    {
        //如果$code为null,则触发所有技能
        if ($code === null) {
            $buffList = $this->buffList[$type] ?? [];
            foreach ($buffList as $buff) {
                if ($buff instanceof BuffBean){
                    $this->useBuff($buff);
                }
            }
        } else {
            $buff = $this->buffList[$type][$code] ?? null;;
            if ($buff instanceof BuffBean) {
                //使用技能
                $this->useBuff($buff);
            }
        }
    }

    public function getBuffInfo($code): ?BuffBean
    {
        $buff = $this->buffCodeList[$code] ?? null;;
        return $buff;
    }

    public function useBuff(BuffBean $buff)
    {
        Logger::getInstance()->log("触发buff{$buff->getBuffName()}");
        $methodName = "useBuff" . Str::studly($buff->getBuffCode());
        $buffResult = $this->$methodName($buff);
        $this->changeAttribute($buffResult);
    }

    protected function ergodicSkillEffect(SkillBean $skill, SkillResult $skillResult)
    {
        //获取$skill的属性
        $effectList = $skill->getEffectParam();
        foreach ($effectList as $effectBean) {
            $type = $effectBean->getType();
            list($targetBaseAttribute, $targetAttribute) = $this->getTargetAttribute($effectBean->getTarget());
            $methodName = 'effect' . Str::studly($type);
            $skillEffectResult = $this->$methodName($targetBaseAttribute, $targetAttribute, $skill, $effectBean);
            $skillResult->addEffectResult($skillEffectResult);
            //触发属性相关
            $this->changeAttribute($targetAttribute, $skillEffectResult);
        }
    }

    /**
     * buff过期
     * decExpireBuff
     * @param $num
     * @author tioncico
     * Time: 9:27 上午
     */
    public function decExpireBuff($num)
    {
        foreach ($this->buffList as $buffCodeList) {
            foreach ($buffCodeList as $buffBean) {
                if ($buffBean instanceof BuffBean) {
                    if ($buffBean->getExpireTime() > 0) {
                        $buffBean->incExpireTime(-$num);
                    }
//                    Logger::getInstance()->console("{$this->attribute->getName()} buff[{$buffBean->getBuffName()}] 剩余时间{$buffBean->getExpireTime()}");
                    if ($buffBean->getExpireTime() <= 0) {
                        $this->buffList[$buffBean->getTriggerType()][$buffBean->getBuffCode()] = null;
                        $this->buffCodeList[$buffBean->getBuffCode()] = null;
                        Logger::getInstance()->console("{$this->attribute->getName()} buff[{$buffBean->getBuffName()}] 过期");
                    }
                }
            }
        }
    }

}
