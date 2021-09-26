<?php

namespace App\HttpController\Api\User\Task;

use App\HttpController\Api\User\UserBase;
use App\Model\Game\Task\GameTaskMasterModel;
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
 * GameTaskMaster
 * Class GameTaskMaster
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User/Task.GameTaskMaster")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameTaskMaster extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Task/GameTaskMaster/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="type",alias="1 主线任务 ",description="1 主线任务 ",lengthMax="255",optional="")
	 * @Param(name="name",alias="任务名",description="任务名",lengthMax="255",optional="")
	 * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
	 * @Param(name="order",alias="排序",description="排序",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'type'=>$param['type'] ?? '',
		    'name'=>$param['name'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'order'=>$param['order'] ?? '',
		];
		$model = new GameTaskMasterModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Task/GameTaskMaster/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="taskMasterId",alias="主任务id",description="主任务id",lengthMax="11",required="")
	 * @Param(name="type",alias="1 主线任务 ",description="1 主线任务 ",lengthMax="255",optional="")
	 * @Param(name="name",alias="任务名",description="任务名",lengthMax="255",optional="")
	 * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
	 * @Param(name="order",alias="排序",description="排序",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskMasterModel();
		$info = $model->get(['taskMasterId' => $param['taskMasterId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['order']=$param['order'] ?? $info->order;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Task/GameTaskMaster/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="taskMasterId",alias="主任务id",description="主任务id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.taskMasterId",description="主任务id")
	 * @ApiSuccessParam(name="result.type",description="1 主线任务 ")
	 * @ApiSuccessParam(name="result.name",description="任务名")
	 * @ApiSuccessParam(name="result.description",description="任务介绍")
	 * @ApiSuccessParam(name="result.order",description="排序")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskMasterModel();
		$info = $model->get(['taskMasterId' => $param['taskMasterId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/User/Task/GameTaskMaster/getList")
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
	 * @ApiSuccessParam(name="result[].taskMasterId",description="主任务id")
	 * @ApiSuccessParam(name="result[].type",description="1 主线任务 ")
	 * @ApiSuccessParam(name="result[].name",description="任务名")
	 * @ApiSuccessParam(name="result[].description",description="任务介绍")
	 * @ApiSuccessParam(name="result[].order",description="排序")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GameTaskMasterModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Task/GameTaskMaster/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="taskMasterId",alias="主任务id",description="主任务id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskMasterModel();
		$info = $model->get(['taskMasterId' => $param['taskMasterId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

