<?php

namespace App\HttpController\Api\User\Task;

use App\HttpController\Api\User\UserBase;
use App\Model\Game\Task\UserDailyTaskPointModel;
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
 * UserDailyTaskPoint
 * Class UserDailyTaskPoint
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User/Task.UserDailyTaskPoint")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserDailyTaskPoint extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Task/UserDailyTaskPoint/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
	 * @Param(name="weekPointNum",alias="每周积分数",description="每周积分数",lengthMax="11",optional="")
	 * @Param(name="dailyPointNum",alias="每日积分",description="每日积分",lengthMax="11",optional="")
	 * @Param(name="lastUpdateTime",alias="上次更新时间",description="上次更新时间",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'],
		    'weekPointNum'=>$param['weekPointNum'] ?? '',
		    'dailyPointNum'=>$param['dailyPointNum'] ?? '',
		    'lastUpdateTime'=>$param['lastUpdateTime'] ?? '',
		];
		$model = new UserDailyTaskPointModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Task/UserDailyTaskPoint/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
	 * @Param(name="weekPointNum",alias="每周积分数",description="每周积分数",lengthMax="11",optional="")
	 * @Param(name="dailyPointNum",alias="每日积分",description="每日积分",lengthMax="11",optional="")
	 * @Param(name="lastUpdateTime",alias="上次更新时间",description="上次更新时间",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskPointModel();
		$info = $model->get(['userId' => $param['userId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['weekPointNum']=$param['weekPointNum'] ?? $info->weekPointNum;
		$updateData['dailyPointNum']=$param['dailyPointNum'] ?? $info->dailyPointNum;
		$updateData['lastUpdateTime']=$param['lastUpdateTime'] ?? $info->lastUpdateTime;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Task/UserDailyTaskPoint/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userId",description="用户id")
	 * @ApiSuccessParam(name="result.weekPointNum",description="每周积分数")
	 * @ApiSuccessParam(name="result.dailyPointNum",description="每日积分")
	 * @ApiSuccessParam(name="result.lastUpdateTime",description="上次更新时间")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskPointModel();
		$info = $model->get(['userId' => $param['userId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/User/Task/UserDailyTaskPoint/getList")
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
	 * @ApiSuccessParam(name="result[].userId",description="用户id")
	 * @ApiSuccessParam(name="result[].weekPointNum",description="每周积分数")
	 * @ApiSuccessParam(name="result[].dailyPointNum",description="每日积分")
	 * @ApiSuccessParam(name="result[].lastUpdateTime",description="上次更新时间")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserDailyTaskPointModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Task/UserDailyTaskPoint/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserDailyTaskPointModel();
		$info = $model->get(['userId' => $param['userId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

