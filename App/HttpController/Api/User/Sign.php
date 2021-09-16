<?php

namespace App\HttpController\Api\User;

use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\SignRewardModel;
use App\Model\Game\UserSignModel;
use App\Service\Game\BackpackService;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiFail;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupAuth;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiRequestExample;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccess;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccessParam;
use EasySwoole\HttpAnnotation\AnnotationTag\InjectParamsContext;
use EasySwoole\HttpAnnotation\AnnotationTag\Method;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Sign
 * Class Sign
 * Create With ClassGeneration
 * @ApiGroup(groupName="签到功能")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Sign extends UserBase
{
    /**
     * @Api(name="获取签到奖励列表和当前连续签到天数",path="/Api/User/Sign/getInfo")
     * @ApiDescription("获取签到奖励列表和当前连续签到天数")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"signRewardList":[{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":10},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":20},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":30},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":40},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":50},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":60},{"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null},"num":70}],"signNum":0,"lastSignTime":0},"msg":"查询成功","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @ApiSuccessParam(name="result.signNum",description="签到天数")
     * @ApiSuccessParam(name="result.lastSignTime",description="最后签到的时间,如果断签则为0")
     * @ApiSuccessParam(name="result.signRewardList.[].signNum",description="签到奖励的天数")
     * @ApiSuccessParam(name="result.signRewardList.[].num",description="奖励的物品数量")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.goodsId",description="物品id")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.name",description="物品名称")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.code",description="物品code值")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.baseCode",description="物品基础类型")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.description",description="介绍")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.gold",description="售出金币")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.isSale",description="是否可售出")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.level",description="等级")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result.signReward.[].goodsInfo.extraData",description="额外数据")
     */
    public function getInfo()
    {
        $signList = SignRewardModel::create()->order('signNum', 'asc')->all();
        //当前用户签到天数
        $signInfo = UserSignModel::create()->get($this->who()->userId);
        $signNum = $signInfo->signNum;
        $lastSignTime = $signInfo->lastUpdateTime ?? 0;
        //如果时间小于昨天
        if ($signInfo->lastUpdateTime < strtotime(date('Y-m-d', time() - 86400))) {
            $signNum = 0;
            $lastSignTime = 0;
        }
        //获取money信息
        $moneyInfo = GoodsModel::create()->getInfoByCode('money');
        $list = [];
        foreach ($signList as $key => $sign) {
            $list[$key]['goodsInfo'] = $moneyInfo;
            $list[$key]['num'] = $sign['money'];
        }

        $data = [
            'signRewardList' => $list,
            'signNum'        => $signNum,
            'lastSignTime'   => $lastSignTime
        ];

        $this->writeJson(Status::CODE_OK, $data, "查询成功");
    }

    /**
     * @Api(name="用户签到",path="/Api/User/Sign/userSign")
     * @ApiDescription("用户签到")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":null,"msg":"签到成功,获得钻石*20","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     */
    public function userSign()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserSignModel();
        $signInfo = $model->getInfo($this->who->userId);
        //如果是今天签到的
        if ($signInfo->lastUpdateTime >= strtotime(date('Y-m-d'))) {
            Assert::assert(false, '你已签到');
        }
        //如果时间小于昨天
        if ($signInfo->lastUpdateTime < strtotime(date('Y-m-d', time() - 86400))) {
            $signNum = 1;
        }
        //获取钻石奖励
        $signRewardInfo = SignRewardModel::create()->get(['signNum' => ($signNum % 7) + 1]);
        Assert::assert(!!$signRewardInfo, '签到奖励配置不存在');

        BaseModel::transaction(function () use ($signInfo, $signRewardInfo, $signNum) {
            $signInfo->update([
                'signNum'        => $signNum,
                'lastUpdateTime' => time()
            ]);
            //增加钻石奖励
            BackpackService::getInstance()->addMoney($this->who->userId, $signRewardInfo->money);
        });

        $this->writeJson(Status::CODE_OK, null, "签到成功,获得钻石*{$signRewardInfo->money}");
    }


}

