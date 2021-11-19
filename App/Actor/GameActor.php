<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
use App\Actor\Data\Map;
use App\Actor\Data\User;
use App\Actor\Fight\Bean\Attribute;
use App\Actor\Fight\Fight;
use App\Actor\Fight\FightReward;
use App\Actor\Goods\GoodsManager;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Service\Game\Fight\Reward;
use App\Service\GameResponse;
use App\Utility\Assert\Assert;
use App\WebSocket\Command;
use App\WebSocket\MsgPushEvent;
use App\WebSocket\Push;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Trigger;
use Swoole\Coroutine\Channel;
use function AlibabaCloud\Client\value;

class GameActor extends BaseActor
{
    use GameActorEventTrait;

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
     * @var GoodsManager
     */
    protected $goodsManager;

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
        $this->goodsManager = new GoodsManager($this->user->userAttribute);
        $this->map = new Map($this->map);
    }

    public function mapInfo()
    {
        $this->push(\App\WebSocket\Command::SC_ACTION_MAP_INFO, 200, "地图信息", [
            'mapInfo' => $this->map->toArray()
        ]);
    }

    public function userInfo()
    {
        $this->push(\App\WebSocket\Command::SC_ACTION_USER_INFO, 200, "用户信息", [
            'userInfo' => $this->user->toArray(),
        ]);
    }

    public function useGoods($param)
    {
        $goodsInfo = GoodsModel::create()->getInfoByCode($param['goodsCode']);
        $goodsResult = $this->goodsManager->useGoods($goodsInfo);
        $this->push(\App\WebSocket\Command::SC_GOODS_RESULT, 200, "物品修改结果", [
            'goodsResult' => $goodsResult->toArray(),
        ]);
    }

    public function exitMap()
    {
        //判断是否结束战斗或者未开始
        Assert::assert(empty($this->fight), "战斗未结束,无法退出");
        //清理用户地图数据
        UserRelationMap::getInstance()->delUserMap($this->userId);
        $this->push(\App\WebSocket\Command::SC_ACTION_EXIT_MAP, 200, "退出地图", [
            'userInfo' => $this->user->toArray(),
            'mapInfo'  => $this->map->toArray()
        ]);
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
        $monster = $this->map->nowMapGrid[$x][$y]['data'] ?? '';
//        $monster->hp = 100;
        if (!$monster instanceof MapMonsterModel) {
            var_dump($this->map->nowMapGrid);
        }
        Assert::assert($monster instanceof MapMonsterModel, "怪物未找到");
        $fight = new Fight($this->user, $monster, function ($event, ...$data) {
//            $this->push( $event, 200, "发送游戏数据", $data);
        });
        $this->fight = $fight;
        $this->initEvent();
        $this->delMonsterEvent($x, $y);
        $fight->startFight();
    }

    /**
     * 用户使用技能
     * useUserSkill
     * @param $param
     * @throws \App\Utility\Assert\AssertException
     * @author tioncico
     * Time: 9:43 上午
     */
    public function useUserSkill($param)
    {
        $skillCode = $param['skillCode'];
        $skillInfo = $this->user->getUserNowAttribute()->getSkillList()[$skillCode] ?? null;
        Assert::assert(!!$skillInfo, "技能不存在");
        $this->user->getUserNowAttribute()->getSkillManager()->useSkill($skillInfo);
    }

    public function nextLevelMap()
    {
        //判断是否还存在怪物
        foreach ($this->map->getNowMapGrid() as $item) {
            foreach ($item as $value) {
                if ($value['type'] == 1) {
                    Assert::assert(false, "还有怪物没有清理");
                }
            }
        }
        Assert::assert($this->map->getMapInfo()->maxLevel >= $this->map->nowMapLevel, "已经通关地下城");
        //下一层
        $this->map->nowMapLevel += 1;
        $this->map->initGrid();
        $this->mapInfo();
        $this->userInfo();
    }

    protected function onException(\Throwable $throwable)
    {
        $actorId = $this->actorId();
        Trigger::getInstance()->throwable($throwable);
        $this->push(\App\WebSocket\Command::SC_ACTION_ERROR, 400, $throwable->getMessage());

        echo "mapActor {$actorId} onException\n";
    }

    protected function push($action, $code, $msg = '', $data = [])
    {
        $data['goodsChange'] = GameResponse::getInstance()->getGoods();
        $command = new Command();
        $command->setAction($action);
        $command->setCode($code);
        $command->setMsg($msg);
        $command->setData($data);
        Logger::getInstance()->info("ws推送:{$action}:{$msg}");
        Push::push($this->userId, $command);
    }

}
