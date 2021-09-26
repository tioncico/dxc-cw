<?php

namespace App\HttpController\Api\Admin\Task;

use App\HttpController\Api\Admin\AdminBase;
use App\Model\Game\Task\GameDailyTaskModel;
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
 * GameDailyTask
 * Class GameDailyTask
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin/Task.GameDailyTask")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameDailyTask extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Task/GameDailyTask/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="name",alias="任务名",description="任务名",lengthMax="255",optional="")
	 * @Param(name="code",alias="任务code",description="任务code",lengthMax="255",optional="")
	 * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
	 * @Param(name="rewardPoint",alias="奖励积分",description="奖励积分",lengthMax="11",optional="")
	 * @Param(name="maxNum",alias="总奖励次数限制",description="总奖励次数限制",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'name'=>$param['name'] ?? '',
		    'code'=>$param['code'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'rewardPoint'=>$param['rewardPoint'] ?? '',
		    'maxNum'=>$param['maxNum'] ?? '',
		];
		$model = new GameDailyTaskModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Task/GameDailyTask/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="gameDailyTaskId",alias="游戏每日任务id",description="游戏每日任务id",lengthMax="11",required="")
	 * @Param(name="name",alias="任务名",description="任务名",lengthMax="255",optional="")
	 * @Param(name="code",alias="任务code",description="任务code",lengthMax="255",optional="")
	 * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
	 * @Param(name="rewardPoint",alias="奖励积分",description="奖励积分",lengthMax="11",optional="")
	 * @Param(name="maxNum",alias="总奖励次数限制",description="总奖励次数限制",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskModel();
		$info = $model->get(['gameDailyTaskId' => $param['gameDailyTaskId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['code']=$param['code'] ?? $info->code;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['rewardPoint']=$param['rewardPoint'] ?? $info->rewardPoint;
		$updateData['maxNum']=$param['maxNum'] ?? $info->maxNum;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Task/GameDailyTask/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="gameDailyTaskId",alias="游戏每日任务id",description="游戏每日任务id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.gameDailyTaskId",description="游戏每日任务id")
	 * @ApiSuccessParam(name="result.name",description="任务名")
	 * @ApiSuccessParam(name="result.code",description="任务code")
	 * @ApiSuccessParam(name="result.description",description="任务介绍")
	 * @ApiSuccessParam(name="result.rewardPoint",description="奖励积分")
	 * @ApiSuccessParam(name="result.maxNum",description="总奖励次数限制")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskModel();
		$info = $model->get(['gameDailyTaskId' => $param['gameDailyTaskId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/Task/GameDailyTask/getList")
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
	 * @ApiSuccessParam(name="result[].gameDailyTaskId",description="游戏每日任务id")
	 * @ApiSuccessParam(name="result[].name",description="任务名")
	 * @ApiSuccessParam(name="result[].code",description="任务code")
	 * @ApiSuccessParam(name="result[].description",description="任务介绍")
	 * @ApiSuccessParam(name="result[].rewardPoint",description="奖励积分")
	 * @ApiSuccessParam(name="result[].maxNum",description="总奖励次数限制")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GameDailyTaskModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Task/GameDailyTask/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="gameDailyTaskId",alias="游戏每日任务id",description="游戏每日任务id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskModel();
		$info = $model->get(['gameDailyTaskId' => $param['gameDailyTaskId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

