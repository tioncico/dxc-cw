<?php

namespace App\HttpController\Api\Common;

use App\Model\ServerModel;
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
 * Server
 * Class Server
 * Create With ClassGeneration
 * @ApiGroup(groupName="服务器信息")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Server extends CommonBase
{
	/**
	 * @Api(name="获取服务器列表",path="/Api/Common/Server/getList")
	 * @ApiDescription("获取数据列表")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":{"page":1,"pageSize":20,"list":[{"serverId":1,"serverName":"测试服","isAllowRegister":1,"serverHost":"game.easyswoole.cn:9501"}],"total":1,"pageCount":1},"msg":"获取列表成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="page", from={GET,POST}, alias="页数", optional="")
	 * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
	 * @ApiSuccessParam(name="result[].serverId",description="服务器id")
	 * @ApiSuccessParam(name="result[].serverName",description="服务器名")
	 * @ApiSuccessParam(name="result[].isAllowRegister",description="是否允许注册")
	 * @ApiSuccessParam(name="result[].serverHost",description="服务器host")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new ServerModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}

}

