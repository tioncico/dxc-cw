<?php

namespace App\HttpController\Api\Admin\Task;

use App\HttpController\Api\Admin\AdminBase;
use App\Model\Game\Task\UserGameTaskCompleteModel;
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
 * UserGameTaskComplete
 * Class UserGameTaskComplete
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin/Task.UserGameTaskComplete")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserGameTaskComplete extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Task/UserGameTaskComplete/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
	 * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",optional="")
	 * @Param(name="taskCode",alias="任务code",description="任务code",lengthMax="255",optional="")
	 * @Param(name="nowNum",alias="当前数量",description="当前数量",lengthMax="11",optional="")
	 * @Param(name="completeNum",alias="完成进度",description="完成进度",lengthMax="11",optional="")
	 * @Param(name="state",alias="0未完成 1已完成 2已领取",description="0未完成 1已完成 2已领取",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'] ?? '',
		    'taskId'=>$param['taskId'] ?? '',
		    'taskCode'=>$param['taskCode'] ?? '',
		    'nowNum'=>$param['nowNum'] ?? '',
		    'completeNum'=>$param['completeNum'] ?? '',
		    'state'=>$param['state'] ?? '',
		];
		$model = new UserGameTaskCompleteModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Task/UserGameTaskComplete/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userTaskCompleteId",alias="玩家任务完成id",description="玩家任务完成id",lengthMax="11",required="")
	 * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
	 * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",optional="")
	 * @Param(name="taskCode",alias="任务code",description="任务code",lengthMax="255",optional="")
	 * @Param(name="nowNum",alias="当前数量",description="当前数量",lengthMax="11",optional="")
	 * @Param(name="completeNum",alias="完成进度",description="完成进度",lengthMax="11",optional="")
	 * @Param(name="state",alias="0未完成 1已完成 2已领取",description="0未完成 1已完成 2已领取",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGameTaskCompleteModel();
		$info = $model->get(['userTaskCompleteId' => $param['userTaskCompleteId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['taskId']=$param['taskId'] ?? $info->taskId;
		$updateData['taskCode']=$param['taskCode'] ?? $info->taskCode;
		$updateData['nowNum']=$param['nowNum'] ?? $info->nowNum;
		$updateData['completeNum']=$param['completeNum'] ?? $info->completeNum;
		$updateData['state']=$param['state'] ?? $info->state;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Task/UserGameTaskComplete/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userTaskCompleteId",alias="玩家任务完成id",description="玩家任务完成id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userTaskCompleteId",description="玩家任务完成id")
	 * @ApiSuccessParam(name="result.userId",description="玩家id")
	 * @ApiSuccessParam(name="result.taskId",description="任务id")
	 * @ApiSuccessParam(name="result.taskCode",description="任务code")
	 * @ApiSuccessParam(name="result.nowNum",description="当前数量")
	 * @ApiSuccessParam(name="result.completeNum",description="完成进度")
	 * @ApiSuccessParam(name="result.state",description="0未完成 1已完成 2已领取")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGameTaskCompleteModel();
		$info = $model->get(['userTaskCompleteId' => $param['userTaskCompleteId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/Task/UserGameTaskComplete/getList")
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
	 * @ApiSuccessParam(name="result[].userTaskCompleteId",description="玩家任务完成id")
	 * @ApiSuccessParam(name="result[].userId",description="玩家id")
	 * @ApiSuccessParam(name="result[].taskId",description="任务id")
	 * @ApiSuccessParam(name="result[].taskCode",description="任务code")
	 * @ApiSuccessParam(name="result[].nowNum",description="当前数量")
	 * @ApiSuccessParam(name="result[].completeNum",description="完成进度")
	 * @ApiSuccessParam(name="result[].state",description="0未完成 1已完成 2已领取")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserGameTaskCompleteModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Task/UserGameTaskComplete/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userTaskCompleteId",alias="玩家任务完成id",description="玩家任务完成id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGameTaskCompleteModel();
		$info = $model->get(['userTaskCompleteId' => $param['userTaskCompleteId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

