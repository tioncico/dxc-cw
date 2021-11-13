<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/11/1 0001
 * Time: 14:42
 */

namespace App\WebSocket\Controller;

use App\Actor\Cache\UserRelationMap;
use App\Actor\GameActor;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserMapModel;
use App\Service\Game\BackpackService;
use App\Utility\Assert\Assert;
use App\WebSocket\Command;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\Socket\AbstractInterface\Controller;
use EasySwoole\Socket\Bean\Response;

/**
 * Class Index
 *
 * 此类是默认的 websocket 消息解析后访问的 控制器
 *
 * @package App\WebSocket
 */
class Index extends BaseController
{

    /**
     * 进入地下城
     * intoMap
     * @throws \App\Utility\Assert\AssertException
     * @throws \EasySwoole\Actor\Exception\InvalidActor
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 4:12 下午
     */
    public function intoMap()
    {
        $userId = $this->userId();
        $param = $this->getParam();
        $mapId = (int)$param['mapId'];
        $mapInfo = UserMapModel::create()->get(['mapId' => $mapId, 'userId' => $userId]);
        Assert::assert(!!$mapInfo, '地图信息不存在或未解锁');
        //获取用户体力
        $userAttribute = UserAttributeModel::create()->get($userId);
        $decPhysicalStrengthNum = 10;
        //每次进入地下城扣除10体力
//        Assert::assert($userAttribute->physicalStrength>=$decPhysicalStrengthNum,'体力不足10点,无法进入地下城');
        //扣除10点体力
//        $userAttribute->update(['physicalStrength'=>QueryBuilder::dec($decPhysicalStrengthNum)]);

        //获取地图actorId
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!$actorId, '你已进入地图');
        //创建地图actor
        $actorId = GameActor::client()->create(['userId' => $userId, 'mapId' => $mapId]);   // 00101000000000000000001
        //创建关联关系
        UserRelationMap::getInstance()->addUserMap($userId, $actorId);
        $this->actorSend('mapInfo');
        $this->actorSend('userInfo');
//        $this->responseMsg(200, "进入地图成功");
    }

    /**
     * 地图信息
     * mapInfo
     * @throws \EasySwoole\Actor\Exception\InvalidActor
     * @author tioncico
     * Time: 4:12 下午
     */
    public function mapInfo()
    {
        $actorId = UserRelationMap::getInstance()->getUserMap($this->userId());
        Assert::assert(!!$actorId, '不在地图中');
        $this->actorSend(Command::CS_MAP_INFO);
    }

    /**
     * 玩家信息
     * mapInfo
     * @throws \EasySwoole\Actor\Exception\InvalidActor
     * @author tioncico
     * Time: 4:12 下午
     */
    public function userInfo()
    {
        $actorId = UserRelationMap::getInstance()->getUserMap($this->userId());
        Assert::assert(!!$actorId, '不在地图中');
        $this->actorSend(Command::CS_USER_INFO);
    }

    /**
     * 战斗
     * fight
     * @throws \App\Utility\Assert\AssertException
     * @author tioncico
     * Time: 4:13 下午
     */
    public function fight()
    {
        $param = $this->getParam();
        $userId = $this->userId();
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!!$actorId, '不在地图中');

        $this->actorSend(Command::CS_FIGHT, ['x' => $param['x'], 'y' => $param['y']]);

    }

    /**
     * 下一层
     * nextLevelMap
     * @throws \App\Utility\Assert\AssertException
     * @throws \EasySwoole\Actor\Exception\InvalidActor
     * @author tioncico
     * Time: 4:13 下午
     */
    public function nextLevelMap()
    {
        $userId = $this->userId();
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!!$actorId, '不在地图中');
        $this->actorSend(Command::CS_NEXT_LEVEL_MAP);
    }

    /**
     * 退出地下城
     * exitMap
     * @throws \App\Utility\Assert\AssertException
     * @author tioncico
     * Time: 4:13 下午
     */
    public function exitMap()
    {
        $userId = $this->userId();
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!!$actorId, '不在地图中');
        $this->actorSend(\App\WebSocket\Command::CS_EXIT_MAP);
    }

    /**
     * 使用技能
     * useSkill
     * @throws \App\Utility\Assert\AssertException
     * @throws \EasySwoole\Actor\Exception\InvalidActor
     * @author tioncico
     * Time: 4:13 下午
     */
    public function useSkill()
    {
        $param = $this->getParam();
        $userId = $this->userId();
        $actorId = UserRelationMap::getInstance()->getUserMap($userId);
        Assert::assert(!!$actorId, '不在地图中');
        $this->actorSend(Command::CS_USE_SKILL,['skillCode' => $param['skillCode']]);
    }

    /**
     * 打开箱子
     * openBox
     * @author tioncico
     * Time: 4:14 下午
     */
    public function openBox(){
        $param = $this->getParam();
        $this->actorSend(Command::CS_OPEN_BOX,['x' => $param['x'], 'y' => $param['y']]);
    }

    /**
     * 逃跑
     * stopFight
     * @author tioncico
     * Time: 4:14 下午
     */
    public function stopFight(){
        $this->actorSend(Command::CS_STOP_FIGHT);
    }


    /**
     * 复活(消耗复活币)
     * revive
     * @author tioncico
     * Time: 4:14 下午
     */
    public function revive(){
        $userId = $this->userId();
        $backpackInfo = UserBackpackModel::create()->getInfoByCode($userId,'revive');
        Assert::assert($backpackInfo->num>=1,"复活币数量不足");
        $goodsInfo = GoodsModel::create()->getInfoByCode('revive');
        BackpackService::getInstance()->decGoods($userId,$goodsInfo,1);
        $this->actorSend(Command::CS_REVIVE);
    }

    public function useGoods(){
        $param = $this->getParam();
        $userId = $this->userId();
        $goodsCode = $param['goodsCode'];
        $backpackInfo = UserBackpackModel::create()->getInfoByCode($userId,$goodsCode);
        Assert::assert($backpackInfo->num>=1,"物品数量不足");

        $goodsInfo = GoodsModel::create()->getInfoByCode('revive');
        BackpackService::getInstance()->decGoods($userId,$goodsInfo,1);
        $this->actorSend(Command::CS_USE_GOODS);
    }

}
