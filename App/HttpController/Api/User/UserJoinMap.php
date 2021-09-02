<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserJoinMapModel;
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
 * UserJoinMap
 * Class UserJoinMap
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserJoinMap")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserJoinMap extends UserBase
{
    /**
     * @Api(name="joinMap",path="/Api/User/UserJoinMap/joinMap")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="mapId",alias="当前地图id",description="当前地图id",lengthMax="11",optional="")
     */
    public function joinMap()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserJoinMapModel();
        $info = $model->get(['userId' => $param['userId']]);
        Assert::assert(!!$info, '用户已经进入地图');

        $data = [
            'userId'=>$this->who->userId,
            'mapId'=>$param['mapId'],
            'nowLevel'=>1,
        ];
        $model = new UserJoinMapModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model, "进入地图成功");
    }


    /**
     * @Api(name="getOne",path="/Api/User/UserJoinMap/getOne")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @ApiSuccessParam(name="result.userId",description="用户id")
     * @ApiSuccessParam(name="result.mapId",description="当前地图id")
     * @ApiSuccessParam(name="result.nowLevel",description="当前地图层数")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserJoinMapModel();
        $info = $model->get(['userId' => $this->who->userId]);
        if ($info) {
            $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
        }
    }
}

