<?php

namespace App\HttpController\Api\User;

use App\Model\BaseModel;
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
     * @ApiSuccess({"code":200,"result":{"signRewardList":[{"id":1,"signNum":1,"money":10},{"id":2,"signNum":2,"money":20},{"id":3,"signNum":3,"money":30},{"id":4,"signNum":4,"money":40},{"id":5,"signNum":5,"money":50},{"id":6,"signNum":6,"money":60},{"id":7,"signNum":7,"money":70}],"signNum":0},"msg":"查询成功","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @ApiSuccessParam(name="result.signNum",description="签到天数")
     * @ApiSuccessParam(name="result.signRewardList.[].signNum",description="签到奖励的天数")
     * @ApiSuccessParam(name="result.signRewardList.[].money",description="签到奖励钻石")
     */
    public function getInfo()
    {
        $signList = SignRewardModel::create()->order('signNum', 'asc')->all();
        //当前用户签到天数
        $signInfo = UserSignModel::create()->get($this->who()->userId);
        $signNum = $signInfo->signNum;
        //如果时间小于昨天
        if ($signInfo->lastUpdateTime < strtotime(date('Y-m-d', time() - 86400))) {
            $signNum = 0;
        }
        $data = [
            'signRewardList' => $signList,
            'signNum'        => $signNum
        ];

        $this->writeJson(Status::CODE_OK, $data, "查询成功");
    }

    /**
     * @Api(name="用户签到",path="/Api/User/UserSign/userSign")
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
        if ($signInfo->lastUpdateTime >= strtotime(date('Y-m-d'))){
            Assert::assert(false,'你已签到');
        }
        //如果时间小于昨天
        if ($signInfo->lastUpdateTime < strtotime(date('Y-m-d', time() - 86400))) {
            $signNum = 1;
        }
        //获取钻石奖励
        $signRewardInfo = SignRewardModel::create()->get(['signNum'=>($signNum%7)+1]);
        Assert::assert(!!$signRewardInfo,'签到奖励配置不存在');

        BaseModel::transaction(function ()use($signInfo,$signRewardInfo,$signNum){
            $signInfo->update([
                'signNum'=>$signNum,
                'lastUpdateTime'=>time()
            ]);
            //增加钻石奖励
            BackpackService::getInstance()->addMoney($this->who->userId,$signRewardInfo->money);
        });

        $this->writeJson(Status::CODE_OK, null, "签到成功,获得钻石*{$signRewardInfo->money}");
    }


}

