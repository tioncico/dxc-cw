<?php

namespace App\HttpController\Api\Common\Task;

use App\HttpController\Api\Common\CommonBase;
use App\Model\Game\Task\UserDailyTaskCompleteModel;
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
 * UserDailyTaskComplete
 * Class UserDailyTaskComplete
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Common/Task.UserDailyTaskComplete")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserDailyTaskComplete extends CommonBase
{
	/**
	 * @Api(name="add",path="/Api/Common/Task/UserDailyTaskComplete/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",lengthMax="11",optional="")
	 * @Param(name="gameDailyTaskId",lengthMax="11",optional="")
	 * @Param(name="completeNum",lengthMax="11",optional="")
	 * @Param(name="date",lengthMax="11",optional="")
	 * @Param(name="addTime",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'] ?? '',
		    'gameDailyTaskId'=>$param['gameDailyTaskId'] ?? '',
		    'completeNum'=>$param['completeNum'] ?? '',
		    'date'=>$param['date'] ?? '',
		    'addTime'=>$param['addTime'] ?? '',
		];
		$model = new UserDailyTaskCompleteModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Common/Task/UserDailyTaskComplete/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userDailyTaskCompleteId",lengthMax="11",required="")
	 * @Param(name="userId",lengthMax="11",optional="")
	 * @Param(name="gameDailyTaskId",lengthMax="11",optional="")
	 * @Param(name="completeNum",lengthMax="11",optional="")
	 * @Param(name="date",lengthMax="11",optional="")
	 * @Param(name="addTime",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskCompleteModel();
		$info = $model->get(['userDailyTaskCompleteId' => $param['userDailyTaskCompleteId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['gameDailyTaskId']=$param['gameDailyTaskId'] ?? $info->gameDailyTaskId;
		$updateData['completeNum']=$param['completeNum'] ?? $info->completeNum;
		$updateData['date']=$param['date'] ?? $info->date;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Common/Task/UserDailyTaskComplete/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userDailyTaskCompleteId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userDailyTaskCompleteId",description="")
	 * @ApiSuccessParam(name="result.userId",description="")
	 * @ApiSuccessParam(name="result.gameDailyTaskId",description="")
	 * @ApiSuccessParam(name="result.completeNum",description="")
	 * @ApiSuccessParam(name="result.date",description="")
	 * @ApiSuccessParam(name="result.addTime",description="")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskCompleteModel();
		$info = $model->get(['userDailyTaskCompleteId' => $param['userDailyTaskCompleteId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Common/Task/UserDailyTaskComplete/getList")
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
	 * @ApiSuccessParam(name="result[].userDailyTaskCompleteId",description="")
	 * @ApiSuccessParam(name="result[].userId",description="")
	 * @ApiSuccessParam(name="result[].gameDailyTaskId",description="")
	 * @ApiSuccessParam(name="result[].completeNum",description="")
	 * @ApiSuccessParam(name="result[].date",description="")
	 * @ApiSuccessParam(name="result[].addTime",description="")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserDailyTaskCompleteModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Common/Task/UserDailyTaskComplete/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userDailyTaskCompleteId",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskCompleteModel();
		$info = $model->get(['userDailyTaskCompleteId' => $param['userDailyTaskCompleteId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

