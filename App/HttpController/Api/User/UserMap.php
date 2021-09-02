<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserMapModel;
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
 * UserMap
 * Class UserMap
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserMap")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserMap extends UserBase
{

    /**
     * @Api(name="getList",path="/Api/User/UserMap/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].userMapId",description="")
     * @ApiSuccessParam(name="result[].userId",description="用户id")
     * @ApiSuccessParam(name="result[].mapId",description="地图id")
     * @ApiSuccessParam(name="result[].addTime",description="新增时间")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 20);
        $model = new UserMapModel();
        $model->where('userId', $this->who->userId);
        $data = $model->with(['mapInfo'],false)->getList($page, $pageSize);
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }

}

