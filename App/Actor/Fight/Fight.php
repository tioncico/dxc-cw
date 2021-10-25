<?php


namespace App\Actor\Fight;


use App\Actor\Buff\BuffManager;
use App\Actor\Data\User;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillManager;
use App\Actor\Skill\SkillList\NormalAttack;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\MonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserPetModel;
use EasySwoole\EasySwoole\Logger;

class Fight
{
    use FightEventHandle;
    /**
     * @var Attribute
     */
    protected $userAttribute;
    /**
     * @var Attribute
     */
    protected $userBaseAttribute;
    /**
     * @var Attribute[]
     */
    protected $petAttributeList = [];

    /**
     * @var Attribute[]
     */
    protected $petBaseAttributeList = [];
    /**
     * @var Attribute
     */
    protected $monsterBaseAttribute;
    /**
     * @var Attribute
     */
    protected $monsterAttribute;
    public $state = 0; //1战斗开始,2战斗结束
    /**
     * @var FightEvent
     */
    protected $event;
    protected $callback;

    public function __construct(User $user, MapMonsterModel $monsterAttribute, callable $callback)
    {
        $this->initUserAttribute($user);
        $this->initMonsterAttribute($monsterAttribute);
        $this->initPetAttribute($user->userPetList);
        $this->registerEvent();
        $this->callback = $callback;
    }

    protected function initUserAttribute(User $user)
    {
        $this->userBaseAttribute = $user->userAttribute;
        $this->userBaseAttribute->setAttributeType(1);
        $this->userAttribute = $user->getUserNowAttribute();
        $skillManager = new SkillManager($this->userBaseAttribute, $this->userAttribute, $this);
        foreach ($this->userAttribute->getSkillList() as $skill){
            $skillManager->addSkill($skill);
        }
        $this->userAttribute->setSkillManager($skillManager);
    }

    protected function initMonsterAttribute(MapMonsterModel $monsterModel)
    {
        $monsterAttribute = new Attribute($monsterModel->toArray());
        $monsterAttribute->setOriginModel($monsterModel);
        $this->monsterBaseAttribute = $monsterAttribute;
        $this->monsterBaseAttribute->setAttributeType(3);
        $this->monsterAttribute = clone $this->monsterBaseAttribute;
        $skillManager = new SkillManager($this->monsterBaseAttribute, $this->monsterAttribute, $this);
        foreach ($this->monsterAttribute->getSkillList() as $skill){
            $skillManager->addSkill($skill);
        }
        $this->monsterAttribute->setSkillManager($skillManager);

        $buffManger = new BuffManager($this->monsterBaseAttribute,$monsterAttribute);
        $this->monsterAttribute->setBuffManager($buffManger);
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

            $skillManager = new SkillManager($this->petBaseAttributeList[$petAttribute->userPetId], $this->petAttributeList[$petAttribute->userPetId], $this);
            foreach ($this->petAttributeList[$petAttribute->userPetId]->getSkillList() as $skill){
                $skillManager->addSkill($skill);
            }
            $this->petAttributeList[$petAttribute->userPetId]->setSkillManager($skillManager);
            $buffManger = new BuffManager($this->petBaseAttributeList[$petAttribute->userPetId], $this->petAttributeList[$petAttribute->userPetId], );
            $this->petAttributeList[$petAttribute->userPetId]->setBuffManager($buffManger);
        }
    }


    public function normalAttack()
    {
        $this->userAttribute->getSkillManager()->trigger('0', '0001');
        $this->monsterAttribute->getSkillManager()->trigger('0', '0001');

        foreach ($this->petAttributeList as $petAttribute) {
            $petAttribute->getSkillManager()->trigger('0', '0001');
        }
    }

    public function pushFightResult($command, ...$data)
    {
        call_user_func($this->callback, $command, ...$data);
    }

    public function startFight()
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
            //怪物死亡
            if ($this->monsterAttribute->isDie()) {
                $this->state = 1;
                $this->event->monsterDie($this->monsterAttribute);
                break;
            }
            //用户死亡
            if ($this->userAttribute->isDie()) {
                $this->state = 1;
                $this->event->userDie($this->userAttribute);
                break;
            }
            $this->event->second01();
            \co::sleep(0.1);
            if ($i >= 10) {
                //1秒定时
                $this->event->second();
                $i = 0;
//                fgets(STDIN);
            } else {
                $i++;
            }
        }
        $this->event->fightEnd();
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
