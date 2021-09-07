<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
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

    /**@var MapMonsterModel[]* */
    protected $monsterList;//当前层怪物列表

    /**@var Fight */
    protected $fight;//战斗状态记录

    /**@var MapMonsterModel */
    protected $monster;

    /**
     * @var SkillAttribute[]
     */
    protected $userSkillList = [
        0 => null,
        1 => null,
        2 => null,
        3 => null,
    ];

    public function __construct(Channel $mailBox, string $actorId, $arg)
    {
        parent::__construct($mailBox, $actorId, $arg);
        $userId = $arg['userId'];
        $mapId = $arg['mapId'];
        $this->user = UserModel::create()->get($userId);
        $this->map = MapModel::create()->get($mapId);
        $skillIds = $arg['skillIds'];
        $this->initSkill($skillIds);
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


    /**
     * 返回地图信息
     * mapInfo
     * @author tioncico
     * Time: 6:56 下午
     */
    public function mapInfo()
    {
        $data = [
            'map'              => $this->map,
            'mapLevel'         => $this->mapLevel,
            'userAttribute'    => $this->userAttribute,
            'monsterAttribute' => $this->monsterAttribute,
            'monsterList'      => $this->monsterList,
            'fight'            => $this->fight,
            'userSkillList'    => $this->userSkillList,
        ];
        MsgPushEvent::getInstance()->msgPush($this->user->userId, 'mapInfo', 200, '地图数据', $data);
    }

    /**
     * 选择最近的怪物战斗
     * fight
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 6:56 下午
     */
    public function fight()
    {
        if ($this->fight && $this->fight->getState() == 1) {
            return;
        }
        if ($this->userAttribute && $this->userAttribute->isDie()) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "你已死亡");
            return;
        }
        $this->refreshUser();

        $monster = array_pop($this->monsterList);
        if (empty($monster)) {
            return;
        }
        $this->monster = $monster;
        $this->monsterAttribute = new Attribute($monster->toArray());
        $this->monsterAttribute->setName($monster->name);
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
            $reward = new Reward($this->user->userId, new UserAttributeModel($this->userAttribute->toArray()), $this->map, $this->monster);
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

            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 200, $msg);
        } else {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 200, "战斗结束,玩家死亡");
        }
    }

    /**
     * 进入下一层
     * nextLevelMap
     * @author tioncico
     * Time: 6:56 下午
     */
    public function nextLevelMap()
    {
        if (!empty($this->monsterList)) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "怪物未清理");
            return;
        }
        if ($this->userAttribute->isDie()) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "你已死亡");
            return;
        }
        if ($this->mapLevel >= $this->map->maxLevel) {
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
        $this->monsterList = null;
        $this->fight = null;
        $this->monster = null;
        $this->exit();
    }

    /**
     * 刷新怪物数据(进入下一层时刷新)
     * refreshMonster
     * @throws \App\Utility\Rand\RandException
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 6:57 下午
     */
    protected function refreshMonster()
    {
        if (!empty($this->monsterList)) {
            return;
        }
        $model = MapMonsterModel::create();
        $list = $model->where('mapId', $this->map->mapId)->where('mapLevelMin', $this->mapLevel, '<=')->where('type', 1)->where('mapLevelMax', $this->mapLevel, '>=')->all();
        //随机n个怪物
        $num = mt_rand(($this->map->monsterNum * 0.5), $this->map->monsterNum);
        $randList = [];
        foreach ($list as $value) {
            $randList[] = new Bean([
                'odds'  => 1,
                'value' => $value
            ]);
        }
        /**
         * @var $monster MapMonsterModel[]
         */
        $randResultList = (new Rand($randList))->randValue($num);
        $monsterList = [];
        foreach ($randResultList as $result) {
            for ($i = $result['num']; $i > 0; $i--) {
                $monsterList [] = $result['info']->getValue();
            }
        }

        //每隔5层随机一个精英怪
        if ($this->mapLevel % 5 == 0) {
            $list = $model->where('mapId', $this->map->mapId)->where('mapLevelMin', $this->mapLevel, '<=')->where('type', 2)->where('mapLevelMax', $this->mapLevel, '>=')->all();
            $elite = Rand::randArray($list, 1);
            if ($elite) {
                $monsterList[] = $elite;
            }
        }
        //打乱数组
        shuffle($monsterList);
        $this->monsterList = $monsterList;
    }

    protected function refreshUser()
    {
        $oldAttribute = $this->userAttribute;
        //获取玩家状态数据
        $userAttribute = UserAttributeModel::create()->getInfo($this->user->userId);
        //升级则更新为满状态
        if (empty($oldAttribute) || $userAttribute->level > $oldAttribute->getLevel()) {
            $this->userAttribute = new Attribute($userAttribute->toArray());
            $this->userAttribute->setName($this->user->nickname);
        }
    }

    /**
     * 停止战斗(当打不过时可以停止)
     * stopFight
     * @author tioncico
     * Time: 6:57 下午
     */
    protected function stopFight()
    {
        //判断是否结束战斗或者未开始
        if ($this->fight->getState() != 1) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未开始,无需退出");
            return;
        }
        $this->fight->setState(0);
        $this->monsterList[] = $this->monster;//原有的怪物重新回到怪物列表
        MsgPushEvent::getInstance()->msgPush($this->user->userId, 'stopFight', 400, "战斗已停止");
    }

    protected function useUserSkill($param)
    {
        var_dump($param);
        $skillId = $param['skillId'];
        $skillInfo = $this->userSkillList[$skillId];
        if (!$this->fight || $this->fight->getState() != 1) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "战斗未开始,无法释放技能");
            return;
        }
        //判断冷却时间
        if ($skillInfo->isCanUse() == false) {
            MsgPushEvent::getInstance()->msgPush($this->user->userId, 'fightEnd', 400, "技能未冷却");
            return;
        }
        //技能攻击
        $fightResult = $this->fight->useSkill($this->userAttribute, $this->monsterAttribute, $skillInfo);
        var_dump(2);
        var_dump($fightResult);
    }

    /**
     * 初始化用户技能
     * initSkill
     * @param $ids
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 6:57 下午
     */
    protected function initSkill($ids)
    {
        //4个技能槽
        for ($i = 0; $i < 4; $i++) {
            if (!empty($ids[$i])) {
//                $skillInfo = UserSkillModel::create()->get($ids[$i]);
//                $this->userSkillList[$i] = new SkillAttribute($skillInfo->toArray());
            }
        }
    }


}
