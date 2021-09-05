<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;
use App\Service\Game\SkillAttribute;
use App\Utility\Rand\Rand;
use EasySwoole\Utility\Str;

class Fight
{
    /**@var Attribute */
    protected $user;
    /**@var Attribute */
    protected $monster;
    protected $state = 0;//0未战斗,1战斗中,2战斗结束

    public function __construct($user, $monster)
    {
        $this->user = $user;
        $this->monster = $monster;
    }

    public function start(callable $callBack)
    {
        $user = $this->user;
        $monster = $this->monster;
        $this->state = 1;
        //战斗开始
        while (1) {
            if ($this->state != 1) {
                break;
            }
            if ($user->isDie()) {
                $this->state = 2;
                break;
            }
            if ($monster->isDie()) {
                $this->state = 2;
                break;
            }
            $userAttackTimes = $user->getAttackTimes();
            if ($userAttackTimes >= 1) {
                //攻击,命中判定
                $userFightResult = $this->attackJudgment($user, $monster);
                //伤害计算
                $this->harmCount($user, $userFightResult);
                //扣血计算
                $this->buckleBloodCalculation($user, $monster, $userFightResult);
                $monster->setHp($monster->getHp() - $userFightResult->getBuckleBloodNum());
                $user->setAttackTimes($user->getAttackTimes() - 1);
                $callBack('user', $userFightResult);
            }
            $monsterAttackTimes = $monster->getAttackTimes();
            if ($monsterAttackTimes >= 1) {
                $monsterFightResult = $this->attackJudgment($monster, $user);
                $this->harmCount($monster, $monsterFightResult);
                $this->buckleBloodCalculation($monster, $user, $monsterFightResult);
                $user->setHp($user->getHp() - $monsterFightResult->getBuckleBloodNum());
                $monster->setAttackTimes($monster->getAttackTimes() - 1);
                $callBack('monster', $monsterFightResult);
            }

            $user->setAttackTimes($user->getAttackTimes() + ($user->getAttackSpeed() * 0.1));
            $monster->setAttackTimes($monster->getAttackTimes() + ($monster->getAttackSpeed() * 0.1));
            //最小单位为每秒10次
            \co::sleep(0.1);
        }
    }

    //攻击判定
    public function attackJudgment(Attribute $attack, Attribute $beAttack)
    {
        $fightResult = new FightResult();
        //计算是否命中
        $randNum = mt_rand(1, 100);
        //未命中
        if ($randNum > $attack->getHitRate()) {
            $fightResult->setIsHit(false);
            return $fightResult;
        }
        //计算是否暴击
        $randNum = mt_rand(1, 100);
        //暴击
        if ($randNum <= $attack->getCriticalRate()) {
            $fightResult->setIsCritical(true);
        }
        return $fightResult;
    }

    public function harmCount(Attribute $attack, FightResult $fightResult)
    {
        //普通攻击伤害=攻击力
        //可能暴击
        $attackNum = $attack->getAttack();
        $harm = $attackNum;
        if ($fightResult->getIsCritical()) {
            $harm = intval($attackNum * $attack->getCriticalStrikeDamage() / 100);
        }
        //计算元素攻击
        if (!empty($attack->getAttackElement())) {
            $fightResult->setAttackElement($attack->getAttackElement());
            //元素伤害
            $fightResult->setElementHarm($attack->getElementNum($attack->getAttackElement()));
        }

        $fightResult->setHarmNum($harm);
        return $harm;
    }

    //扣血计算
    public function buckleBloodCalculation(Attribute $attack, Attribute $beAttack, FightResult $fightResult)
    {
        //扣血计算=初始伤害-(防御力*2.5)
        $buckleBlood = intval($fightResult->getHarmNum() - ($beAttack->getDefense() * 2.5));

        if ($buckleBlood <= 0) {
            $buckleBlood = 1;//强制扣除1点血
        }
        $fightResult->setBuckleBloodNum($buckleBlood);
        return $buckleBlood;
    }


    public function useSkill(Attribute $attackAttribute, Attribute $beAttackAttribute, SkillAttribute $skillAttribute)
    {
        //攻击,命中判定
        $fightResult = $this->attackJudgment($attackAttribute, $beAttackAttribute);
        $entryCode = $skillAttribute->getEntryCode();
        $actionName = 'entry' . Str::studly($entryCode);
        $this->$actionName($attackAttribute, $beAttackAttribute, $skillAttribute, $fightResult);
        //伤害计算
        $this->harmCount($attackAttribute, $fightResult);
        //扣血计算
        $this->buckleBloodCalculation($attackAttribute, $beAttackAttribute, $fightResult);
        return $fightResult;
    }


    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }

}
