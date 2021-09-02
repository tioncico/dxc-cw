<?php


namespace App\Service\Game\Fight;


use App\Service\Game\Attribute;

class Fight
{
    /**@var Attribute */
    protected $user;
    /**@var Attribute */
    protected $monster;

    public function __construct($user, $monster)
    {
        $this->user = $user;
        $this->monster = $monster;
    }

    public function start()
    {
        //战斗开始
        while (1) {
            $userAttackTimes = $this->user->getAttackTimes();
            if ($userAttackTimes >= 1) {
                echo time()."玩家攻击\n";
                $this->user->setAttackTimes($this->user->getAttackTimes()-1);
            }
            $monsterAttackTimes = $this->monster->getAttackTimes();
            if ($monsterAttackTimes >= 1) {
                echo time()."怪物攻击\n";
                $this->monster->setAttackTimes($this->monster->getAttackTimes()-1);
            }

            $this->user->setAttackTimes($this->user->getAttackTimes()+($this->user->getAttackSpeed()*0.1));
            $this->monster->setAttackTimes( $this->monster->getAttackTimes()+($this->monster->getAttackSpeed()*0.1));
            //最小单位为每秒10次
            \co::sleep(0.1);
        }
    }

    public function msectime()
    { //返回当前的毫秒时间戳
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

}
