<?php


namespace App\Actor\Fight;


class Fight
{
    protected $userAttribute;
    protected $petAttributeList;
    protected $monsterAttribute;
    public $state=0; //1战斗开始,2战斗结束

    public function __construct($userAttribute,$petAttributeList,$monsterAttribute)
    {
        $this->userAttribute = $userAttribute;
        $this->petAttributeList = $petAttributeList;
        $this->monsterAttribute = $monsterAttribute;
    }
    public function start(callable $callBack)
    {
        $this->state = 1;
        //战斗开始
        while (1) {
            if ($this->state != 1) {
                break;
            }

            \co::sleep(0.1);
        }
    }


}
