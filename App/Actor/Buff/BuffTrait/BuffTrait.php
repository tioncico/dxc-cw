<?php


namespace App\Actor\Buff\BuffTrait;


use App\Actor\Buff\Buff002;
use App\Actor\Buff\BuffBean;
use App\Actor\Buff\BuffResult\BuffResult;
use App\Actor\Skill\SkillEffectResult;

trait BuffTrait
{
    public function useBuff002(Buff002 $buffBean)
    {
        $num = $this->evalRenderVariable($buffBean, $buffBean->getNumCount());
        $property = $buffBean->getPropertyName();
        $buffResult = new BuffResult();
        $buffResult->setBuffInfo($buffBean);
        $buffResult->addPropertyChange($property, $num);
        return $buffResult;
    }

}
