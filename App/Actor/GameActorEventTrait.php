<?php


namespace App\Actor;


use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapMonsterModel;
use App\Service\Game\Fight\Reward;
use EasySwoole\EasySwoole\Logger;

trait GameActorEventTrait
{
    public function initEvent(){
        $this->rewardEvent();
        $this->fightEndEvent();
    }


    protected function fightEndEvent()
    {
        $fight = $this->fight;
        $fight->getEvent()->register('FIGHT_END', 'delFightObj', function () {
            $this->fight = null;
        });
    }


    protected function rewardEvent()
    {
        /**
         * @var $fight Fight
         */
        $fight = $this->fight;
        $fight->getEvent()->register('MONSTER_DIE', 'reward', function ($event,Attribute $attribute)  {
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
            Logger::getInstance()->log($msg);
        });
    }
}
