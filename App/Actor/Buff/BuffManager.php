<?php

namespace App\Actor\Buff;

use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Actor\Skill\Effect\EffectBean;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillBean;
use App\Actor\Skill\SkillEffectResult;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Actor\Skill\SkillTrait\ChangeAttribute;
use App\Actor\Skill\SkillTrait\EffectAddBuff;
use App\Actor\Skill\SkillTrait\Event;
use App\Actor\Skill\SkillTrait\TemplateHandle;
use App\Utility\Assert\Assert;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Utility\Str;
use App\Actor\Skill\SkillTrait\EffectHarm;

class BuffManager
{
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
        Logger::getInstance()->log("触发buff管理");
        //如果$code为null,则触发所有技能
        if ($code === null) {
            $buffList = $this->buffList[$type]??[];
            foreach ($buffList as $buff) {
                $this->useBuff($buff, $effectResult);
            }
        } else {
            $buff = $this->buffList[$type][$code] ?? '';;
            if ($buff) {
                //使用技能
                $this->useBuff($buff, $effectResult);
            }
        }
    }

    public function getBuffInfo($code): ?BuffBean
    {
        $buff = $this->buffCodeList[$code] ?? null;;
        return $buff;
    }

    public function useBuff(BuffBean $buff, SkillEffectResult $effectResult)
    {
        Logger::getInstance()->log("触发buff{$buff->getBuffName()}");
        $buff->useBuff($effectResult);
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

    /**
     * 获取释放目标类型
     * getEffectTargetType
     * @param $targetType
     * @return int
     * @author tioncico
     * Time: 9:27 上午
     */
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

    /**
     * 获取技能指向目标
     * getTargetAttribute
     * @param $targetType
     * @return array
     * @author tioncico
     * Time: 9:26 上午
     */
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
