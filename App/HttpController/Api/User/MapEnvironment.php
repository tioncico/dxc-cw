<?php

namespace App\HttpController\Api\User;

use App\Model\Game\MapEnvironmentModel;
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
 * MapEnvironment
 * Class MapEnvironment
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.MapEnvironment")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class MapEnvironment extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/MapEnvironment/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",required="")
	 * @Param(name="name",alias="环境名",description="环境名",lengthMax="255",optional="")
	 * @Param(name="description",alias="环境介绍",description="环境介绍",lengthMax="255",optional="")
	 * @Param(name="recommendedLevelValue",alias="建议等级",description="建议等级",lengthMax="255",optional="")
	 * @Param(name="isInstanceZone",alias="是否为副本",description="是否为副本",lengthMax="1",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'mapEnvironmentId'=>$param['mapEnvironmentId'],
		    'name'=>$param['name'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'recommendedLevelValue'=>$param['recommendedLevelValue'] ?? '',
		    'isInstanceZone'=>$param['isInstanceZone'] ?? '',
		];
		$model = new MapEnvironmentModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/MapEnvironment/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",required="")
	 * @Param(name="name",alias="环境名",description="环境名",lengthMax="255",optional="")
	 * @Param(name="description",alias="环境介绍",description="环境介绍",lengthMax="255",optional="")
	 * @Param(name="recommendedLevelValue",alias="建议等级",description="建议等级",lengthMax="255",optional="")
	 * @Param(name="isInstanceZone",alias="是否为副本",description="是否为副本",lengthMax="1",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapEnvironmentModel();
		$info = $model->get(['mapEnvironmentId' => $param['mapEnvironmentId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['recommendedLevelValue']=$param['recommendedLevelValue'] ?? $info->recommendedLevelValue;
		$updateData['isInstanceZone']=$param['isInstanceZone'] ?? $info->isInstanceZone;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/MapEnvironment/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.mapEnvironmentId",description="环境id")
	 * @ApiSuccessParam(name="result.name",description="环境名")
	 * @ApiSuccessParam(name="result.description",description="环境介绍")
	 * @ApiSuccessParam(name="result.recommendedLevelValue",description="建议等级")
	 * @ApiSuccessParam(name="result.isInstanceZone",description="是否为副本")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapEnvironmentModel();
		$info = $model->get(['mapEnvironmentId' => $param['mapEnvironmentId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/MapEnvironment/getList")
	 * @ApiDescription("获取数据列表")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="page", from={GET,POST}, alias="页数", optional="")
	 * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
	 * @ApiSuccessParam(name="result[].mapEnvironmentId",description="环境id")
	 * @ApiSuccessParam(name="result[].name",description="环境名")
	 * @ApiSuccessParam(name="result[].description",description="环境介绍")
	 * @ApiSuccessParam(name="result[].recommendedLevelValue",description="建议等级")
	 * @ApiSuccessParam(name="result[].isInstanceZone",description="是否为副本")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new MapEnvironmentModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/MapEnvironment/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapEnvironmentModel();
		$info = $model->get(['mapEnvironmentId' => $param['mapEnvironmentId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

