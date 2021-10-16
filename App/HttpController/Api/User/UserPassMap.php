<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserPassMapModel;
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
 * UserPassMap
 * Class UserPassMap
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserPassMap")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserPassMap extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/UserPassMap/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",optional="")
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",optional="")
	 * @Param(name="difficultyLevel",alias="难度",description="难度",lengthMax="255",optional="")
	 * @Param(name="addTime",alias="通关时间",description="通关时间",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'],
		    'mapId'=>$param['mapId'] ?? '',
		    'mapEnvironmentId'=>$param['mapEnvironmentId'] ?? '',
		    'difficultyLevel'=>$param['difficultyLevel'] ?? '',
		    'addTime'=>$param['addTime'] ?? '',
		];
		$model = new UserPassMapModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/UserPassMap/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userPassMapId",lengthMax="11",required="")
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",optional="")
	 * @Param(name="mapEnvironmentId",alias="环境id",description="环境id",lengthMax="11",optional="")
	 * @Param(name="difficultyLevel",alias="难度",description="难度",lengthMax="255",optional="")
	 * @Param(name="addTime",alias="通关时间",description="通关时间",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserPassMapModel();
		$info = $model->get(['userPassMapId' => $param['userPassMapId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['mapId']=$param['mapId'] ?? $info->mapId;
		$updateData['mapEnvironmentId']=$param['mapEnvironmentId'] ?? $info->mapEnvironmentId;
		$updateData['difficultyLevel']=$param['difficultyLevel'] ?? $info->difficultyLevel;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserPassMap/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userPassMapId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userPassMapId",description="")
	 * @ApiSuccessParam(name="result.userId",description="用户id")
	 * @ApiSuccessParam(name="result.mapId",description="地图id")
	 * @ApiSuccessParam(name="result.mapEnvironmentId",description="环境id")
	 * @ApiSuccessParam(name="result.difficultyLevel",description="难度")
	 * @ApiSuccessParam(name="result.addTime",description="通关时间")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserPassMapModel();
		$info = $model->get(['userPassMapId' => $param['userPassMapId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="delete",path="/Api/User/UserPassMap/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userPassMapId",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserPassMapModel();
		$info = $model->get(['userPassMapId' => $param['userPassMapId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

