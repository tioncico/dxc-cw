<?php

namespace App\Actor\Skill;

use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Actor\Skill\Effect\EffectBean;
use App\Actor\Skill\Effect\Harm;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Actor\Skill\SkillTrait\ChangeAttribute;
use App\Actor\Skill\SkillTrait\Effect001;
use App\Actor\Skill\SkillTrait\EffectAddBuff;
use App\Actor\Skill\SkillTrait\Event;
use App\Actor\Skill\SkillTrait\TemplateHandle;
use App\Utility\Assert\Assert;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Utility\Str;
use App\Actor\Skill\SkillTrait\EffectHarm;

class SkillManager
{
    use EffectHarm;
    use TemplateHandle;
    use Event;
    use ChangeAttribute;
    use EffectAddBuff;

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
        $this->addSkill(new NormalAttack());
    }

    public function addSkill(SkillBean $skillBean)
    {
        $this->skillList[$skillBean->getTriggerType()][$skillBean->getSkillCode()] = $skillBean;
    }

    public function trigger($type, $code = null)
    {
        //如果$code为null,则触发所有技能
        if ($code === null) {
            $skillList = $this->skillList[$type] ?? [];
            foreach ($skillList as $skill) {
                $this->useSkill($skill);
            }
        } else {
            $skill = $this->skillList[$type][$code] ?? '';;
            if ($skill) {
                //使用技能
                $this->useSkill($skill);
            }
        }
    }

    public function useSkill(SkillBean $skill)
    {
        //判断技能是否冷却
        if ($skill->getTickTime() > 0) {
            return false;
        }
        if (($monaCostNum = $this->checkManaCost($skill)) === false) {
            Assert::assert(false, "魔法不足");
        }
        $skillResult = new SkillResult(['skillInfo' => $skill]);
        $skillResult->setManaCostNum($monaCostNum);
        Logger::getInstance()->log("{$this->attribute->getName()}{$skill->getSkillName()} 触发");
        //判断释放概率
        $isHit = $this->checkUseSkillMiss($skill);
        if ($isHit) {
            //触发事件
            $this->onSkillBefore($skillResult);
            //遍历技能效果
            $this->ergodicSkillEffect($skill, $skillResult);
        } else {
            Logger::getInstance()->console("技能{$skill->getSkillName()} miss");
            $skillResult->setIsMiss(1);
        }
        $this->coolSkill($skill);
        $this->onSkillAfter($skillResult);
    }

    protected function checkManaCost(SkillBean $skill)
    {
        $manaCostNum = $this->evalRenderVariable(null, null, $skill, $skill->getManaCost());
        if ($manaCostNum > $this->attribute->getMp()) {
            return false;
        } else {
            $this->attribute->incMp(-$manaCostNum);
            return $manaCostNum;
        }
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

    protected function checkUseSkillMiss(SkillBean $skill)
    {
        $hitRateStr = $skill->getTriggerRate();
        $rate = $this->evalRenderVariable(null, null, $skill, $hitRateStr);
        $num = mt_rand(1, 100);
        if ($num <= $rate) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 冷却技能
     * coolSkill
     * @param SkillBean $skill
     * @author tioncico
     * Time: 9:27 上午
     */
    public function coolSkill(SkillBean $skill)
    {
        $coolingTimeStr = $skill->getCoolingTime();
        $coolNum = $this->evalRenderVariable(null, null, $skill, $coolingTimeStr);
        Logger::getInstance()->log("{$this->attribute->getName()}{$skill->getSkillName()} 进入冷却{$coolNum}秒");
        $skill->setTickTime($coolNum);
    }

    /**
     * 降低技能冷却
     * decCoolSkill
     * @param $num
     * @author tioncico
     * Time: 9:27 上午
     */
    public function decCoolSkill($num)
    {
        foreach ($this->skillList as $skillCodeList) {
            foreach ($skillCodeList as $skill) {
                if ($skill->getTickTime() > 0) {
//                    Logger::getInstance()->console("{$this->attribute->getName()}{$skill->getSkillName()} 冷却时间{$skill->getTickTime()}");
                    $skill->incTickTime(-$num);
                    if ($skill->getTickTime() <= 0) {
                        Logger::getInstance()->console("{$this->attribute->getName()}{$skill->getSkillName()} 技能冷却完成");
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
