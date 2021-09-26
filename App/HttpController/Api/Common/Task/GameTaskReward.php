<?php

namespace App\HttpController\Api\Common\Task;

use App\HttpController\Api\Common\CommonBase;
use App\Model\Game\Task\GameTaskRewardModel;
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
 * GameTaskReward
 * Class GameTaskReward
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Common/Task.GameTaskReward")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameTaskReward extends CommonBase
{
	/**
	 * @Api(name="add",path="/Api/Common/Task/GameTaskReward/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="num",alias="数量",description="数量",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'taskId'=>$param['taskId'] ?? '',
		    'goodsCode'=>$param['goodsCode'] ?? '',
		    'num'=>$param['num'] ?? '',
		];
		$model = new GameTaskRewardModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Common/Task/GameTaskReward/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="taskRewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="num",alias="数量",description="数量",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskRewardModel();
		$info = $model->get(['taskRewardId' => $param['taskRewardId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['taskId']=$param['taskId'] ?? $info->taskId;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['num']=$param['num'] ?? $info->num;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Common/Task/GameTaskReward/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="taskRewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.taskRewardId",description="奖励id")
	 * @ApiSuccessParam(name="result.taskId",description="任务id")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result.num",description="数量")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskRewardModel();
		$info = $model->get(['taskRewardId' => $param['taskRewardId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Common/Task/GameTaskReward/getList")
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
	 * @ApiSuccessParam(name="result[].taskRewardId",description="奖励id")
	 * @ApiSuccessParam(name="result[].taskId",description="任务id")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result[].num",description="数量")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GameTaskRewardModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Common/Task/GameTaskReward/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="taskRewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameTaskRewardModel();
		$info = $model->get(['taskRewardId' => $param['taskRewardId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

