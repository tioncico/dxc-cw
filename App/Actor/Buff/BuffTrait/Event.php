<?php


namespace App\Actor\Buff\BuffTrait;


use App\Actor\Skill\SkillList\NormalAttack;
use App\Actor\Skill\SkillResult;

trait Event
{
    /**
     * 技能释放前事件
     * onSkillBefore
     * @param SkillResult $skillResult
     * @author tioncico
     * Time: 9:28 上午
     */
    protected function onSkillBefore(SkillResult $skillResult)
    {
        if ($skillResult->getSkillInfo() instanceof NormalAttack) {
            switch ($this->attributeType) {
                case 1:
                    $this->fight->getEvent()->userNormalAttackBefore($this->attribute, $skillResult);
                    break;
                case 2:
                    $this->fight->getEvent()->petNormalAttackBefore($this->attribute, $skillResult);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterNormalAttackBefore($this->attribute, $skillResult);
                    break;
            }
        } else {
            switch ($this->attributeType) {
                case 1:
                    $this->fight->getEvent()->userSkillBefore($this->attribute, $skillResult);
                    break;
                case 2:
                    $this->fight->getEvent()->petSkillBefore($this->attribute, $skillResult);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterSkillBefore($this->attribute, $skillResult);
                    break;
            }
        }
    }

    /**
     * 技能释放事件
     * onSkillAfter
     * @param SkillResult $skillResult
     * @author tioncico
     * Time: 9:27 上午
     */
    protected function onSkillAfter(SkillResult $skillResult)
    {
        if ($skillResult->getSkillInfo() instanceof NormalAttack) {
            switch ($this->attributeType) {
                case 1:
                    $this->fight->getEvent()->userNormalAttackAfter($this->attribute, $skillResult);
                    break;
                case 2:
                    $this->fight->getEvent()->petNormalAttackAfter($this->attribute, $skillResult);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterNormalAttackAfter($this->attribute, $skillResult);
                    break;
            }
        } else {
            switch ($this->attributeType) {
                case 1:
                    $this->fight->getEvent()->userSkillAfter($this->attribute, $skillResult);
                    break;
                case 2:
                    $this->fight->getEvent()->petSkillAfter($this->attribute, $skillResult);
                    break;
                case 3:
                    $this->fight->getEvent()->monsterSkillAfter($this->attribute, $skillResult);
                    break;
            }
        }
    }
}
