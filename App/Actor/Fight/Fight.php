<?php


namespace App\Actor\Fight;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillManager;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\MonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserPetModel;

class Fight
{
    protected $userAttribute;
    protected $userBaseAttribute;
    protected $petAttributeList = [];
    protected $petBaseAttributeList = [];
    protected $monsterBaseAttribute;
    protected $monsterAttribute;
    public $state = 0; //1战斗开始,2战斗结束
    protected $event;

    public function __construct(UserAttributeModel $userAttribute, $petAttributeList, MapMonsterModel $monsterAttribute)
    {
        $this->event = new FightEvent();
        $this->initUserAttribute($userAttribute);
        $this->initMonsterAttribute($monsterAttribute);
        $this->initPetAttribute($petAttributeList);
        $this->registerEvent();
    }

    protected function initUserAttribute(UserAttributeModel $userAttribute)
    {
        $this->userBaseAttribute = new Attribute($userAttribute->toArray());
        $this->userBaseAttribute->setAttributeType(1);
        $this->userAttribute = clone $this->userBaseAttribute;
        $skillManager = new SkillManager($this->userBaseAttribute, $this->userAttribute,$this);
        $skillManager->addSkill(new NormalAttack());
        $this->userAttribute->setSkillManager($skillManager);
    }

    protected function initMonsterAttribute(MapMonsterModel $monsterAttribute)
    {
        $this->monsterBaseAttribute = new Attribute($monsterAttribute->toArray());;
        $this->monsterBaseAttribute->setAttributeType(3);
        $this->monsterAttribute = clone $this->monsterBaseAttribute;
        $skillManager = new SkillManager($this->monsterBaseAttribute, $this->monsterAttribute,$this);
        $skillManager->addSkill(new NormalAttack());
        $this->monsterAttribute->setSkillManager($skillManager);

    }

    protected function initPetAttribute($petAttributeList)
    {
        /**
         * @var $petAttribute UserPetModel
         */
        foreach ($petAttributeList as $petAttribute) {
            $this->petBaseAttributeList[$petAttribute->userPetId] = new Attribute($petAttribute->toArray());;
            $this->petBaseAttributeList[$petAttribute->userPetId]->setAttributeType(2);
            $this->petAttributeList[$petAttribute->userPetId] = clone $this->petBaseAttributeList[$petAttribute->userPetId];

            $skillManager = new SkillManager($this->petBaseAttributeList[$petAttribute->userPetId],$this->petAttributeList[$petAttribute->userPetId],$thisZ);
            $skillManager->addSkill(new NormalAttack());
            $this->petAttributeList[$petAttribute->userPetId]->setSkillManager($skillManager);
        }
    }

    public function registerEvent()
    {
        //普通攻击
        $this->event->register('SECOND_01', 'normalAttack', function () {
            $this->normalAttack();
        });
        //全局技能冷却
        $this->event->register('SECOND_01', 'skillCool', function () {
            $this->userAttribute->getSkillManager()->decCoolSkill(0.1);
            $this->monsterAttribute->getSkillManager()->decCoolSkill(0.1);
            foreach ($this->petAttributeList as $petAttribute){
                $petAttribute->getSkillManager()->decCoolSkill(0.1);
            }
        });


    }

    public function normalAttack()
    {
        $this->userAttribute->getSkillManager()->trigger('0', '0001');
        $this->monsterAttribute->getSkillManager()->trigger('0', '0001');
        foreach ($this->petAttributeList as $petAttribute) {
            $petAttribute->getSkillManager()->trigger('0', '0001');
        }
    }

    public function startFight(callable $callBack)
    {
        $this->state = 1;
        $i = 0;
        $this->event->fightStart();
        //战斗开始
        while (1) {
            //战斗结束判定
            if ($this->state != 1) {
                $this->event->fightEnd();
                break;
            }
            //用户死亡
            if ($this->userAttribute->isDie()) {
                $this->state = 1;
                $this->event->userDie();
                break;
            }
            //怪物死亡
            if ($this->monsterAttribute->isDie()) {
                $this->state = 1;
                $this->event->monsterDie();
                break;
            }
            $this->event->second01();
            \co::sleep(0.1);
            if ($i >= 10) {
                //1秒定时
                $this->event->second();
                $i = 0;
            } else {
                $i++;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUserAttribute()
    {
        return $this->userAttribute;
    }

    /**
     * @return mixed
     */
    public function getUserBaseAttribute()
    {
        return $this->userBaseAttribute;
    }

    /**
     * @return array
     */
    public function getPetAttributeList(): array
    {
        return $this->petAttributeList;
    }

    /**
     * @return array
     */
    public function getPetBaseAttributeList(): array
    {
        return $this->petBaseAttributeList;
    }

    /**
     * @return mixed
     */
    public function getMonsterBaseAttribute()
    {
        return $this->monsterBaseAttribute;
    }

    /**
     * @return mixed
     */
    public function getMonsterAttribute()
    {
        return $this->monsterAttribute;
    }

    /**
     * @return FightEvent
     */
    public function getEvent(): FightEvent
    {
        return $this->event;
    }


}
