<?php


namespace App\HttpController\Api\User;


use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use EasySwoole\Http\Message\Status;
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

class GameInfo extends UserBase
{
    /**
     * @Api(name="玩家信息获取",path="/Api/User/GameInfo/userInfo")
     * @ApiDescription("玩家信息获取")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     */
    public function userInfo()
    {
        //获取用户数据
        $userAttributeInfo = UserAttributeModel::create()->getInfo($this->who->userId);
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($this->who->userId);
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($this->who->userId);
        $data = [
            'attributeInfo' => $userAttributeInfo,
            'goldNum'       => $userGoldInfo->num,
            'moneyNum'      => $userMoneyInfo->num,
        ];
        $this->writeJson(Status::CODE_OK, $data, "获取数据成功");
    }

}
