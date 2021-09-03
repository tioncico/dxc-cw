<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;
use App\Utility\Rand\Rand;

class Fight
{
    /**@var Attribute */
    protected $user;
    /**@var Attribute */
    protected $monster;
    protected $state=0;//0未战斗,1战斗中,2战斗结束

    public function __construct($user, $monster)
    {
        $this->user = $user;
        $this->monster = $monster;
    }

    public function start(callable $callBack)
    {
        $user = $this->user;
        $monster = $this->monster;
        //战斗开始
        while (1) {
            if ($user->isDie()){
                $this->state=2;
                break;
            }
            if ($monster->isDie()){
                $this->state=2;
                break;
            }
            $userAttackTimes = $user->getAttackTimes();
            if ($userAttackTimes >= 1) {
                $userFightResult = $this->attackJudgment($user, $monster);
                $monster->setHp($monster->getHp()-$userFightResult->getBuckleBloodNum());
                $user->setAttackTimes($user->getAttackTimes() - 1);
                $callBack('user',$userFightResult);
            }
            $monsterAttackTimes = $monster->getAttackTimes();
            if ($monsterAttackTimes >= 1) {
                $monsterFightResult = $this->attackJudgment($monster, $user);
                $user->setHp($user->getHp()-$monsterFightResult->getBuckleBloodNum());
                $monster->setAttackTimes($monster->getAttackTimes() - 1);
                $callBack('monster',$monsterFightResult);
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
        $this->harmCount($attack, $fightResult);
        $this->buckleBloodCalculation($attack, $beAttack, $fightResult);
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
        if (!empty($attack->getAttackElement())){
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

        if ($buckleBlood<=0){
            $buckleBlood=1;//强制扣除1点血
        }
        $fightResult->setBuckleBloodNum($buckleBlood);
        return $buckleBlood;
    }

}
