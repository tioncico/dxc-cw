<?php

namespace App\HttpController\Api\User\Task;

use App\HttpController\Api\User\UserBase;
use App\Model\Game\Task\UserDailyTaskReceiveModel;
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
 * UserDailyTaskReceive
 * Class UserDailyTaskReceive
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User/Task.UserDailyTaskReceive")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserDailyTaskReceive extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Task/UserDailyTaskReceive/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
	 * @Param(name="rewardId",alias="奖励id",description="奖励id",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 * @Param(name="date",alias="领取日期",description="领取日期",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'] ?? '',
		    'rewardId'=>$param['rewardId'] ?? '',
		    'addTime'=>$param['addTime'] ?? '',
		    'date'=>$param['date'] ?? '',
		];
		$model = new UserDailyTaskReceiveModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Task/UserDailyTaskReceive/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userDailyTaskReceiveId",alias="玩家每日任务领取id",description="玩家每日任务领取id",lengthMax="11",required="")
	 * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
	 * @Param(name="rewardId",alias="奖励id",description="奖励id",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 * @Param(name="date",alias="领取日期",description="领取日期",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskReceiveModel();
		$info = $model->get(['userDailyTaskReceiveId' => $param['userDailyTaskReceiveId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['rewardId']=$param['rewardId'] ?? $info->rewardId;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$updateData['date']=$param['date'] ?? $info->date;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Task/UserDailyTaskReceive/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userDailyTaskReceiveId",alias="玩家每日任务领取id",description="玩家每日任务领取id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userDailyTaskReceiveId",description="玩家每日任务领取id")
	 * @ApiSuccessParam(name="result.userId",description="玩家id")
	 * @ApiSuccessParam(name="result.rewardId",description="奖励id")
	 * @ApiSuccessParam(name="result.addTime",description="新增时间")
	 * @ApiSuccessParam(name="result.date",description="领取日期")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskReceiveModel();
		$info = $model->get(['userDailyTaskReceiveId' => $param['userDailyTaskReceiveId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/User/Task/UserDailyTaskReceive/getList")
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
	 * @ApiSuccessParam(name="result[].userDailyTaskReceiveId",description="玩家每日任务领取id")
	 * @ApiSuccessParam(name="result[].userId",description="玩家id")
	 * @ApiSuccessParam(name="result[].rewardId",description="奖励id")
	 * @ApiSuccessParam(name="result[].addTime",description="新增时间")
	 * @ApiSuccessParam(name="result[].date",description="领取日期")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserDailyTaskReceiveModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Task/UserDailyTaskReceive/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userDailyTaskReceiveId",alias="玩家每日任务领取id",description="玩家每日任务领取id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskReceiveModel();
		$info = $model->get(['userDailyTaskReceiveId' => $param['userDailyTaskReceiveId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

