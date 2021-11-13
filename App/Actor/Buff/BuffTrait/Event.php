<?php


namespace App\Actor\Buff\BuffTrait;


use App\Actor\Buff\BuffBean;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Actor\Skill\SkillResult;

trait Event
{
    protected $eventHandle=[
        'addBuffEvent'=>[],
        'buffResult'=>[],
    ];

    public function addBuffEvent(Attribute $attribute, BuffBean $buffBean)
    {
        foreach ($this->eventHandle['addBuffEvent'] as $name=>$callback){
            call_user_func($callback,$name,$attribute,$buffBean);
        }
    }
    public function buffResult(Attribute $attribute, BuffBean $buffBean)
    {
        foreach ($this->eventHandle['buffResult'] as $name=>$callback){
            call_user_func($callback,$name,$attribute,$buffBean);
        }
    }

    public function addEventHandle($event,$name,callable $callback){
        $this->eventHandle[$event][$name] = $callback;
    }
}
