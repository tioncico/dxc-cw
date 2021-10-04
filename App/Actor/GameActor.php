<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
use App\Actor\Data\Map;
use App\Actor\Data\User;
use App\Actor\Fight\Fight;
use App\Actor\Fight\FightReward;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Service\Game\Fight\Reward;
use App\Utility\Assert\Assert;
use App\WebSocket\MsgPushEvent;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Trigger;
use Swoole\Coroutine\Channel;
use function AlibabaCloud\Client\value;

class GameActor extends BaseActor
{
    protected $userId;
    protected $mapId;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Map
     */
    protected $map;
    protected $fight;

    /**
     * MapActor constructor.
     * @param Channel $mailBox
     * @param string  $actorId
     * @param         $arg
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function __construct(Channel $mailBox, string $actorId, $arg)
    {
        parent::__construct($mailBox, $actorId, $arg);
        $this->userId = $arg['userId'];
        $this->mapId = $arg['mapId'];
    }

    public static function configure(ActorConfig $actorConfig)
    {
        $actorConfig->setActorName('mapActor');
        $actorConfig->setWorkerNum(3);
    }

    protected function onStart()
    {
        $this->user = new User($this->userId);
        $this->map = new Map($this->map);
    }

    public function mapInfo()
    {
        MsgPushEvent::getInstance()->msgPush($this->userId, \App\WebSocket\Command::SC_ACTION_GAME_INFO, 200, "发送游戏初始化信息", [
            'userInfo' => $this->user->toArray(),
            'mapInfo'  => $this->map->toArray()
        ]);
    }

    public function exitMap()
    {
        //判断是否结束战斗或者未开始
//        if ($this->fight->getState() == 1) {
//            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未结束,无法退出");
//            return;
//        }
        //清理用户地图数据
        UserRelationMap::getInstance()->delUserMap($this->user->userId);
        //清理类数据
        $this->user = null;
        $this->map = null;
        $this->exit();
    }

    public function fight($param)
    {
        Assert::assert(empty($this->fight), "战斗已开始");
        $x = $param['x'] ?? 0;
        $y = $param['y'] ?? 0;
        $monster = $this->map->nowMapGrid[$x][$y] ?? '';

        Assert::assert($monster instanceof MapMonsterModel, "怪物未找到");
        $fight = new Fight($this->user->userAttribute, $this->user->userPetList, $monster, function ($event, ...$data) {
            MsgPushEvent::getInstance()->msgPush($this->userId, $event, 200, "发送游戏数据", $data);
        });
        $this->fight = $fight;
        $this->rewardEvent($monster);
        $this->fightEndEvent();
        $this->delMonsterEvent($x, $y);
        $fight->startFight();
    }

    protected function fightEndEvent()
    {
        $this->fight->getEvent()->register('FIGHT_END', 'delFightObj', function () {
            $this->fight = null;
        });
    }

    protected function delMonsterEvent($x, $y)
    {
        $this->fight->getEvent()->register('MONSTER_DIE', 'deleteMonster', function () use ($x, $y) {
            $this->map->nowMapGrid[$x][$y] = null;
            Logger::getInstance()->log("{$x},{$y}怪物死亡,删除");
        });
    }

    protected function rewardEvent(MapMonsterModel $monster)
    {
        $this->fight->getEvent()->register('MONSTER_DIE', 'reward', function () use ($monster) {
            //计算奖励
            $reward = new Reward($this->user->userAttribute->userId, $this->user->userAttribute, $this->map->mapInfo, $monster);
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

    protected function onException(\Throwable $throwable)
    {
        $actorId = $this->actorId();
        Trigger::getInstance()->throwable($throwable);
        MsgPushEvent::getInstance()->msgPush($this->userId, \App\WebSocket\Command::SC_ACTION_ERROR, 400, $throwable->getMessage());

        echo "mapActor {$actorId} onException\n";
    }

}
