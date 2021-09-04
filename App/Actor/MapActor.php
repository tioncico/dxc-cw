<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\User\UserModel;
use App\Service\Game\Attribute;
use App\Service\Game\Fight\Fight;
use App\Service\Game\Fight\FightResult;
use App\Service\Game\Fight\Reward;
use App\Utility\Rand\Rand;
use App\WebSocket\MsgPushEvent;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use Swoole\Coroutine\Channel;

class MapActor extends BaseActor
{
    /**
     * @var UserModel
     */
    protected $user;
    /**
     * @var MapModel
     */
    protected $map;

    protected $mapLevel;//当前关卡

    /**@var Attribute */
    protected $userAttribute;//用户状态记录

    /**@var Attribute */
    protected $monsterAttribute;//怪物状态记录

    /**@var Fight */
    protected $fight;//战斗状态记录

    /**@var MapMonsterModel */
    protected $monster;

    public function __construct(Channel $mailBox, string $actorId, $arg)
    {
        parent::__construct($mailBox, $actorId, $arg);
        $userId = $arg['userId'];
        $mapId = $arg['mapId'];
        $this->user = UserModel::create()->get($userId);
        $this->map = MapModel::create()->get($mapId);
    }

    public static function configure(ActorConfig $actorConfig)
    {
        $actorConfig->setActorName('mapActor');
        $actorConfig->setWorkerNum(3);
    }

    protected function onStart()
    {
        $actorId = $this->actorId();
        $this->mapLevel = 1;
        $this->refreshMonster();
        $this->refreshUser();
        echo "mapActor {$actorId} onStart\n";
    }


    public function mapInfo()
    {
        $data = [
            'map'              => $this->map,
            'mapLevel'         => $this->mapLevel,
            'userAttribute'    => $this->userAttribute,
            'monsterAttribute' => $this->monsterAttribute,
            'fight'            => $this->fight,
        ];
        MsgPushEvent::getInstance()->msgPush($this->user->userId, 'mapInfo', 200, '地图数据', $data);
    }

    public function fight()
    {
        if ($this->fight && $this->fight->getState() == 1) {
            return;
        }
//        if ($this->monsterAttribute&&$this->monsterAttribute->isDie()){
//            return;
//        }
        if ($this->userAttribute&&$this->userAttribute->isDie()){
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "你已死亡");
            return;
        }

        $this->refreshMonster();
        $this->refreshUser();
        $this->monsterAttribute = new Attribute($this->monster->toArray());
        $this->monsterAttribute->setName($this->monster->name);
        echo "玩家{$this->userAttribute->getName()}({$this->userAttribute->getLevel()}级)\n";
        echo "怪物{$this->monsterAttribute->getName()}({$this->monsterAttribute->getLevel()}级)\n";

        $this->fight = new Fight($this->userAttribute, $this->monsterAttribute);
        $this->fight->start(function ($attackName, FightResult $fightResult) {
            $msg = '';
            if ($fightResult->getIsHit() == false) {
                $msg .= "miss";
            } else {
                if (!empty($fightResult->getElementHarm())) {
                    $msg .= "{$fightResult->getElementHarm()}元素攻击";
                }
                if ($fightResult->getIsCritical() == true) {
                    $msg .= "[暴击]";
                }
                $msg .= "伤害" . $fightResult->getHarmNum();
            }

            if ($attackName == 'user') {
                MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fight', 200, "玩家攻击,{$msg},怪物hp:{$this->monsterAttribute->getHp()}");
            } else {
                MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fight', 200, "怪物攻击,{$msg},玩家hp:{$this->userAttribute->getHp()}");
            }
        });
        //战斗结束
        if ($this->monsterAttribute->isDie()) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 200, "战斗结束,怪物死亡");
            //计算奖励
            $reward = new Reward($this->user->userId,new UserAttributeModel($this->userAttribute->toArray()), $this->map, $this->monster);
            $reward->rewardCount();
            $reward->addUserData();

            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 200, "金币+{$reward->getGold()},经验+{$reward->getExp()}");
        } else {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 200, "战斗结束,玩家死亡");
        }
    }

    public function nextLevelMap()
    {
        if ($this->fight && $this->fight->getState() == 1) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未结束,无法进入下一层");
            return;
        }
        if ($this->userAttribute->isDie()){
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "你已死亡");
            return;
        }
        if ($this->mapLevel >= 10) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "地图已经通过,请退出地下城修整吧");
            return;
        }
        //清理怪物数据
        $this->monster = null;
        $this->monsterAttribute = null;
        $this->mapLevel += 1;
        //重新刷新怪物数据
        $this->refreshMonster();
        MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "进入第{$this->mapLevel}层");
    }

    /**
     * 退出地图
     * exitMap
     * @author tioncico
     * Time: 4:49 下午
     */
    public function exitMap()
    {
        //判断是否结束战斗或者未开始
        if ($this->fight->getState() == 1) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未结束,无法退出");
            return;
        }
        //清理用户地图数据
        UserRelationMap::getInstance()->delUserMap($this->user->userId);
        //清理类数据
        $this->user = null;
        $this->map = null;
        $this->mapLevel = null;
        $this->userAttribute = null;
        $this->monsterAttribute = null;
        $this->fight = null;
        $this->monster = null;
        $this->exit();
    }

    protected function refreshMonster()
    {
        if (!empty($this->monster)) {
            return;
        }
        $model = MapMonsterModel::create();
        $list = $model->where('mapId', $this->map->mapId)->where('mapLevelMin', $this->mapLevel, '<=')->where('mapLevelMax', $this->mapLevel, '>=')->all();
        //随机一个
        /**
         * @var $monster MapMonsterModel
         */
        $monster = Rand::randArray($list, 1);
        $this->monster = $monster;
    }

    protected function refreshUser()
    {
        $oldAttribute = $this->userAttribute;
        //获取玩家状态数据
        $userAttribute = UserAttributeModel::create()->getInfo($this->user->userId);
        //升级则更新为满状态
        if (empty($oldAttribute)||$userAttribute->level>$oldAttribute->getLevel()){
            $this->userAttribute = new Attribute($userAttribute->toArray());
            $this->userAttribute->setName($this->user->nickname);
        }
    }

    protected function stopFight()
    {
        //判断是否结束战斗或者未开始
        if ($this->fight->getState() != 1) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未开始,无需退出");
            return;
        }
        $this->fight->setState(0);
        MsgPushEvent::getInstance()->msgPush($this->user->userId, 'stopFight', 400, "战斗已停止");
    }
}
