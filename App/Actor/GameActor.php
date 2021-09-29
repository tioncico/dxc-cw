<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
use App\Actor\Data\Map;
use App\Actor\Data\User;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserSkillModel;
use App\Model\User\UserModel;
use App\Service\Game\Attribute;
use App\Service\Game\Fight\Fight;
use App\Service\Game\Fight\FightResult;
use App\Service\Game\Fight\Reward;
use App\Service\Game\SkillAttribute;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;
use App\WebSocket\MsgPushEvent;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use Swoole\Coroutine\Channel;
use function AlibabaCloud\Client\value;

class GameActor extends BaseActor
{
    protected $userId;
    protected $mapId;
    protected $user;
    protected $map;

    /**
     * 进入地图步骤
     * 初始化用户属性
     * 初始化用户装备属性,用户装备额外属性,用户装备高级属性,用户装备套装属性
     * 初始化用户宠物属性
     * 初始化用户技能
     * 初始化宠物技能
     * 初始化地图数据
     * 初始化地图怪物,地图怪物技能
     * 初始化地图随机事件(开箱子,新怪物)
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

    public function mapInfo(){
        MsgPushEvent::getInstance()->msgPush($this->userId, \App\WebSocket\Command::SC_ACTION_GAME_INFO, 200, "发送游戏初始化信息",[
            'userInfo'=>$this->user->toArray(),
            'mapInfo'=>$this->map->toArray()
        ]);
    }

    public function exitMap(){
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

    public function fight(){

    }



}
