<?php

namespace App\Actor\Fight\Bean;
use App\Service\Game\Fight\Skill;
use EasySwoole\Spl\SplBean;

class Attribute extends SplBean
{
    protected $hp = 100; //血量
    protected $mp = 100; //法力
    protected $name = null; //名称
    protected $level = 1; //等级
    protected $attack = 1; //攻击力
    protected $defense = 1; //防御力
    protected $endurance = 1; //耐力
    protected $intellect = 1; //智力
    protected $strength = 1; //力量
    protected $criticalRate = 10; //暴击率
    protected $criticalStrikeDamage = 200; //暴击伤害
    protected $hitRate = 90; //命中率
    protected $dodgeRate = 0; //闪避率
    protected $penetrate = 0; //穿透力
    protected $attackSpeed = 0.4; //攻击速度
    protected $userElement = 0; //角色元素
    protected $attackElement = 0; //攻击元素
    protected $jin = 0; //金
    protected $mu = 0; //木
    protected $tu = 0; //土
    protected $sui = 0; //水
    protected $huo = 0; //火
    protected $light = 0; //光
    protected $dark = 0; //暗
    protected $luck = 0;//幸运
    protected $attackTimes = 1;//攻击次数
    protected $isDie = false;
    /**
     * @var Buff[]
     */
    protected $buffList = [// 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发,10释放技能前触发,11释放技能后触发
        0  => [],
        1  => [],
        2  => [],
        3  => [],
        4  => [],
        5  => [],
        6  => [],
        7  => [],
        8  => [],
        9  => [],
        10 => [],
        11 => [],
    ];

    /**
     * @var Skill[][]
     */
    protected $skillList = [];

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


    /**
     * @return int
     */
    public function getAttackTimes(): float
    {
        return $this->attackTimes;
    }

    /**
     * @param float $attackTimes
     */
    public function setAttackTimes(float $attackTimes): void
    {
        $this->attackTimes = $attackTimes;
    }

    public function incAttackTimes(float $attackTimes)
    {
        $this->attackTimes += $attackTimes;
    }

    /**
     * @return mixed
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param mixed $hp
     */
    public function setHp($hp): void
    {
        $this->hp = $hp;
        if ($this->hp <= 0) {
            $this->isDie = true;
        }
    }

    public function incHp(int $hp)
    {
        $this->hp += $hp;
    }

    /**
     * @return mixed
     */
    public function getMp()
    {
        return $this->mp;
    }

    /**
     * @param mixed $mp
     */
    public function setMp($mp): void
    {
        $this->mp = $mp;
    }

    public function incMp(int $mp)
    {
        $this->mp += $mp;
    }

    /**
     * @return mixed
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @param mixed $attack
     */
    public function setAttack($attack): void
    {
        $this->attack = $attack;
    }

    /**
     * @param mixed $attack
     */
    public function incAttack($attack): void
    {
        $this->attack += $attack;
    }

    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param mixed $defense
     */
    public function setDefense($defense): void
    {
        $this->defense = $defense;
    }
    /**
     * @param mixed $defense
     */
    public function incDefense($defense): void
    {
        $this->defense += $defense;
    }

    /**
     * @return mixed
     */
    public function getEndurance()
    {
        return $this->endurance;
    }

    /**
     * @param mixed $endurance
     */
    public function setEndurance($endurance): void
    {
        $this->endurance = $endurance;
    }

    /**
     * @return mixed
     */
    public function getIntellect()
    {
        return $this->intellect;
    }

    /**
     * @param mixed $intellect
     */
    public function setIntellect($intellect): void
    {
        $this->intellect = $intellect;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getEnduranceQualification()
    {
        return $this->enduranceQualification;
    }

    /**
     * @param mixed $enduranceQualification
     */
    public function setEnduranceQualification($enduranceQualification): void
    {
        $this->enduranceQualification = $enduranceQualification;
    }

    /**
     * @return mixed
     */
    public function getIntellectQualification()
    {
        return $this->intellectQualification;
    }

    /**
     * @param mixed $intellectQualification
     */
    public function setIntellectQualification($intellectQualification): void
    {
        $this->intellectQualification = $intellectQualification;
    }

    /**
     * @return mixed
     */
    public function getStrengthQualification()
    {
        return $this->strengthQualification;
    }

    /**
     * @param mixed $strengthQualification
     */
    public function setStrengthQualification($strengthQualification): void
    {
        $this->strengthQualification = $strengthQualification;
    }

    /**
     * @return mixed
     */
    public function getCriticalRate()
    {
        return $this->criticalRate;
    }

    /**
     * @param mixed $criticalRate
     */
    public function setCriticalRate($criticalRate): void
    {
        $this->criticalRate = $criticalRate;
    }

    /**
     * @return mixed
     */
    public function getCriticalStrikeDamage()
    {
        return $this->criticalStrikeDamage;
    }

    /**
     * @param mixed $criticalStrikeDamage
     */
    public function setCriticalStrikeDamage($criticalStrikeDamage): void
    {
        $this->criticalStrikeDamage = $criticalStrikeDamage;
    }

    /**
     * @return mixed
     */
    public function getHitRate()
    {
        return $this->hitRate;
    }

    /**
     * @param mixed $hitRate
     */
    public function setHitRate($hitRate): void
    {
        $this->hitRate = $hitRate;
    }

    /**
     * @return mixed
     */
    public function getPenetrate()
    {
        return $this->penetrate;
    }

    /**
     * @param mixed $penetrate
     */
    public function setPenetrate($penetrate): void
    {
        $this->penetrate = $penetrate;
    }

    /**
     * @return mixed
     */
    public function getAttackSpeed()
    {
        return $this->attackSpeed;
    }

    /**
     * @param mixed $attackSpeed
     */
    public function setAttackSpeed($attackSpeed): void
    {
        $this->attackSpeed = $attackSpeed;
    }

    /**
     * @return mixed
     */
    public function getUserElement()
    {
        return $this->userElement;
    }

    /**
     * @param mixed $userElement
     */
    public function setUserElement($userElement): void
    {
        $this->userElement = $userElement;
    }

    /**
     * @return mixed
     */
    public function getAttackElement()
    {
        return $this->attackElement;
    }

    /**
     * @param mixed $attackElement
     */
    public function setAttackElement($attackElement): void
    {
        $this->attackElement = $attackElement;
    }

    /**
     * @return mixed
     */
    public function getJin()
    {
        return $this->jin;
    }

    /**
     * @param mixed $jin
     */
    public function setJin($jin): void
    {
        $this->jin = $jin;
    }

    /**
     * @return mixed
     */
    public function getMu()
    {
        return $this->mu;
    }

    /**
     * @param mixed $mu
     */
    public function setMu($mu): void
    {
        $this->mu = $mu;
    }

    /**
     * @return mixed
     */
    public function getTu()
    {
        return $this->tu;
    }

    /**
     * @param mixed $tu
     */
    public function setTu($tu): void
    {
        $this->tu = $tu;
    }

    /**
     * @return mixed
     */
    public function getSui()
    {
        return $this->sui;
    }

    /**
     * @param mixed $sui
     */
    public function setSui($sui): void
    {
        $this->sui = $sui;
    }

    /**
     * @return mixed
     */
    public function getHuo()
    {
        return $this->huo;
    }

    /**
     * @param mixed $huo
     */
    public function setHuo($huo): void
    {
        $this->huo = $huo;
    }

    /**
     * @return mixed
     */
    public function getLight()
    {
        return $this->light;
    }

    /**
     * @param mixed $light
     */
    public function setLight($light): void
    {
        $this->light = $light;
    }

    /**
     * @return mixed
     */
    public function getDark()
    {
        return $this->dark;
    }

    /**
     * @param mixed $dark
     */
    public function setDark($dark): void
    {
        $this->dark = $dark;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck($luck): void
    {
        $this->luck = $luck;
    }

    /**
     * @return bool
     */
    public function isDie(): bool
    {
        return $this->isDie;
    }

    /**
     * @param bool $isDie
     */
    public function setIsDie(bool $isDie): void
    {
        $this->isDie = $isDie;
    }

    public function getElementNum($elementType)
    {
        $array = [
            'jin'   => $this->jin,
            'mu'    => $this->mu,
            'tu'    => $this->tu,
            'sui'   => $this->sui,
            'huo'   => $this->huo,
            'light' => $this->light,
            'dark'  => $this->dark,
        ];
        return $array[$elementType];
    }

    /**
     * @return int
     */
    public function getDodgeRate(): int
    {
        return $this->dodgeRate;
    }

    /**
     * @param int $dodgeRate
     */
    public function setDodgeRate(int $dodgeRate): void
    {
        $this->dodgeRate = $dodgeRate;
    }

    /**
     * @return Buff[]
     */
    public function getBuffList(): array
    {
        return $this->buffList;
    }

    /**
     * @param Buff[] $buffList
     */
    public function setBuffList(array $buffList): void
    {
        $this->buffList = $buffList;
    }

    public function getBuffByTypeAndCode(int $type, string $code)
    {
        if (isset($this->buffList[$type][$code])) {
            $oldBuffInfo = $this->buffList[$type][$code];
            if ($oldBuffInfo->getExpireTime() < time()) {
                unset($this->buffList[$type][$code]);
                return null;
            }
            return $oldBuffInfo;
        } else {
            return null;
        }
    }

    public function addBuff(Buff $buff)
    {
        //判断是否存在该buff并且没有过期
        if ($oldBuffInfo = $this->getBuffByTypeAndCode($buff->getType(), $buff->getCode())) {
            //没有过期,则判断是否可以叠加层数
            if ($oldBuffInfo->getStackLayer() > 1 && $oldBuffInfo->getNowStackLayer() < $oldBuffInfo->getStackLayer()) {
                $oldBuffInfo->incNowStackLayer(1);
            }
            //刷新过期时间
            $oldBuffInfo->setExpireTime($buff->getExpireTime());
        } else {
            $this->buffList[$buff->getType()][$buff->getCode()] = $buff;
        }
    }

    /**
     * @return Fight\Skill[]
     */
    public function getSkillList(): array
    {
        return $this->skillList;
    }

    /**
     * @param Fight\Skill[][] $skillList
     */
    public function setSkillList(array $skillList): void
    {
        $this->skillList = $skillList;
    }


    public function addSkill(SkillAttribute $skill)
    {
        $this->skillList[$skill->getEntryCode()] = $skill;
    }
    public function getSkillByCode($code):?SkillAttribute
    {
        return $this->skillList[$code];
    }

    public function __toString()
    {
        return "
血量:{$this->hp}
法力:{$this->mp}
攻击力:{$this->attack}
防御力:{$this->defense}
耐力:{$this->endurance}
智力:{$this->intellect}
力量:{$this->strength}
耐力资质:{$this->enduranceQualification}
智力资质:{$this->intellectQualification}
力量资质:{$this->strengthQualification}
暴击率:{$this->criticalRate}
暴击伤害:{$this->criticalStrikeDamage}
命中率:{$this->hitRate}
闪避率:{$this->dodgeRate}
穿透力:{$this->penetrate}
攻击速度:{$this->attackSpeed}
角色元素:{$this->userElement}
攻击元素:{$this->attackElement}
金:{$this->jin}
木:{$this->mu}
土:{$this->tu}
水:{$this->sui}
火:{$this->huo}
光:{$this->light}
暗:{$this->dark}
幸运:{$this->luck}
攻击次数:{$this->attackTimes}
";
    }


}
