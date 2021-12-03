<?php


namespace App\Actor;


use App\Actor\Buff\BuffBean;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Actor\Skill\SkillEffectResult;
use App\Actor\Skill\SkillResult;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapMonsterModel;
use App\Service\Game\Fight\Reward;
use App\WebSocket\MsgPushEvent;
use App\WebSocket\Push;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\ServerManager;

trait GameActorEventTrait
{
    public function initEvent()
    {
        $this->rewardEvent();
        $this->fightEndEvent();
        $this->fightStartEvent();
        $this->skillEvent();
        $this->buckleBloodEvent();
        $this->buffEvent();
        $this->userDie();
    }

    protected function buffEvent()
    {
        /**
         * @var $fight Fight
         */
        $fight = $this->fight;

        $addBuffEventFunction = function ($name, Attribute $attribute, BuffBean $buffBean) {
            $this->push(\App\WebSocket\Command::SC_ACTION_BUFF_ADD, 200, 'buff增加推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'buffBean'      => $buffBean
            ]);
        };
        $buffResultEventFunction = function ($name, Attribute $attribute, BuffBean $buffBean) {
            $this->push(\App\WebSocket\Command::SC_ACTION_BUFF_RESULT, 200, 'buff结果推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'buffBean'      => $buffBean
            ]);
        };


        $fight->getUserAttribute()->getBuffManager()->addEventHandle('addBuffEvent', 'pushWS', $addBuffEventFunction);
        $fight->getMonsterAttribute()->getBuffManager()->addEventHandle('addBuffEvent', 'pushWS', $addBuffEventFunction);
        foreach ($fight->getPetAttributeList() as $attribute) {
            $attribute->getBuffManager()->addEventHandle('addBuffEvent', 'pushWS', $addBuffEventFunction);
        }

        $fight->getUserAttribute()->getBuffManager()->addEventHandle('buffResult', 'pushWS', $buffResultEventFunction);
        $fight->getMonsterAttribute()->getBuffManager()->addEventHandle('buffResult', 'pushWS', $buffResultEventFunction);
        foreach ($fight->getPetAttributeList() as $attribute) {
            $attribute->getBuffManager()->addEventHandle('buffResult', 'pushWS', $buffResultEventFunction);
        }

    }

    protected function skillEvent()
    {
        $fight = $this->fight;
        $fight->getEvent()->register('USE_SKILL_BEFORE', 'pushWS', function ($eventName, Attribute $attribute, SkillResult $skillResult) {
            $this->push(\App\WebSocket\Command::SC_ACTION_SKILL_BEFORE, 200, '使用技能前推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'skillResult'   => $skillResult
            ]);
        });
        $fight->getEvent()->register('USE_SKILL_AFTER', 'pushWS', function ($eventName, Attribute $attribute, SkillResult $skillResult) {
            $this->push(\App\WebSocket\Command::SC_ACTION_SKILL_AFTER, 200, '使用技能后推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'skillResult'   => $skillResult
            ]);
        });
    }

    protected function buckleBloodEvent()
    {
        $fight = $this->fight;
        $fight->getEvent()->register('USER_BUCKLE_BLOOD_AFTER', 'pushWS', function ($eventName, Attribute $attribute, SkillEffectResult $skillResult) {
            $this->push(\App\WebSocket\Command::SC_ACTION_SKILL_BEFORE, 200, '扣血后推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'skillResult'   => $skillResult
            ]);
        });
        $fight->getEvent()->register('MONSTER_BUCKLE_BLOOD_AFTER', 'pushWS', function ($eventName, Attribute $attribute, SkillEffectResult $skillResult) {
            $this->push(\App\WebSocket\Command::SC_ACTION_SKILL_BEFORE, 200, '扣血后推送', [
                'attributeId'   => $attribute->getAttributeId(),
                'attributeType' => $attribute->getAttributeType(),
                'skillResult'   => $skillResult
            ]);
        });
    }


    protected function fightEndEvent()
    {
        $fight = $this->fight;
        $fight->getEvent()->register('FIGHT_END', 'delFightObj', function () {
            $this->fight = null;

            $this->push(\App\WebSocket\Command::SC_ACTION_FIGHT_END, 200, "战斗结束", null);
        });
    }

    protected function fightStartEvent()
    {
        /**
         * @var $fight Fight
         */
        $fight = $this->fight;
        $monsterInfo = $fight->getMonsterAttribute()->toArray();
        $fight->getEvent()->register('FIGHT_START', 'pushWs', function () use ($monsterInfo) {
            $this->push(\App\WebSocket\Command::SC_ACTION_FIGHT, 200, "战斗开始推送", [
                'monsterInfo' => $monsterInfo,
            ]);
        });
    }


    protected function rewardEvent()
    {
        /**
         * @var $fight Fight
         */
        $fight = $this->fight;
        $fight->getEvent()->register('MONSTER_DIE', 'reward', function ($event, Attribute $attribute) {
            $monster = $attribute->getOriginModel();
            //计算奖励
            $reward = new Reward($this->userId, $this->map->mapInfo, $monster);
            $reward->rewardCount();
            $reward->addUserData();
            $msg = "金币+{$reward->getGold()},经验+{$reward->getExp()}";
            if ($reward->getGoodsList()) {
                /**
                 * @var $goodsInfo GoodsModel
                 */
                foreach ($reward->getGoodsList() as $value) {
                    $goodsInfo = $value['goodsInfo'];
                    $msg .= "  {$goodsInfo->name}*{$value['num']}";
                }
            }
            $this->push(\App\WebSocket\Command::SC_ACTION_MONSTER_DIE, 200, '怪物死亡');
            Logger::getInstance()->log($msg);
        });
    }


    /**
     * 删除怪物
     * delMonsterEvent
     * @param $x
     * @param $y
     * @author tioncico
     * Time: 9:43 上午
     */
    protected function delMonsterEvent($x, $y)
    {
        $this->fight->getEvent()->register('MONSTER_DIE', 'deleteMonster', function () use ($x, $y) {
            $this->map->nowMapGrid[$x][$y] = [
                'type' => 0,
                'data' => null
            ];
            Logger::getInstance()->log("{$x},{$y}怪物死亡,删除");
        });
    }


    /**
     * 用户死亡
     * delMonsterEvent
     * @author tioncico
     * Time: 9:43 上午
     */
    protected function userDie()
    {
        $this->fight->getEvent()->register('USER_DIE', 'userDie', function () {
            $this->push(\App\WebSocket\Command::SC_ACTION_USER_DIE, 200, "玩家死亡", null);

        });
    }

}
