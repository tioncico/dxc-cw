<?php


namespace App\Actor;


use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\User\UserModel;
use App\Service\Game\Attribute;
use App\Service\Game\Fight\Fight;
use App\Utility\Rand\Rand;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use Swoole\Coroutine\Channel;

class MapActor extends AbstractActor
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
        //获取玩家状态数据
        $userAttribute = UserAttributeModel::create()->getInfo($this->user->userId);
        $this->userAttribute= new Attribute($userAttribute->toArray());
        $this->userAttribute->setName($this->user->nickname);
        //获取一个1级的怪物
        $model = MapMonsterModel::create();
        $list =$model ->where('mapId', $this->map->mapId)->where('mapLevelMin', $this->mapLevel, '<=')->where('mapLevelMax', $this->mapLevel, '>=')->all();
        //随机一个
        /**
         * @var $monster MapMonsterModel
         */
        $monster = Rand::randArray($list, 1);
        $this->monsterAttribute= new Attribute($monster->toArray());
        $this->monsterAttribute->setName($monster->name);
        echo "玩家{$this->userAttribute->getName()}({$this->userAttribute->getLevel()}级)\n";
        echo "怪物{$this->monsterAttribute->getName()}({$this->monsterAttribute->getLevel()}级)\n";

        echo "mapActor {$actorId} onStart\n";
    }

    protected function onMessage($msg)
    {
        $actorId = $this->actorId();
        echo "mapActor {$actorId} onMessage\n";
    }

    protected function onExit($arg)
    {
        $actorId = $this->actorId();
        echo "mapActor {$actorId} onExit\n";
    }

    protected function onException(\Throwable $throwable)
    {
        $actorId = $this->actorId();
        echo "mapActor {$actorId} onException\n";
    }
}
