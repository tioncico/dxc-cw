<?php

namespace App\HttpController\Api\Common\Task;

use App\HttpController\Api\Common\CommonBase;
use App\Model\Game\Task\GameDailyTaskPointRewardModel;
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
 * GameDailyTaskPointReward
 * Class GameDailyTaskPointReward
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Common/Task.GameDailyTaskPointReward")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameDailyTaskPointReward extends CommonBase
{
	/**
	 * @Api(name="add",path="/Api/Common/Task/GameDailyTaskPointReward/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="type",alias="1每日奖励,2每周奖励",description="1每日奖励,2每周奖励",lengthMax="255",optional="")
	 * @Param(name="pointNum",alias="积分数",description="积分数",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsNum",alias="物品数量",description="物品数量",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'type'=>$param['type'] ?? '',
		    'pointNum'=>$param['pointNum'] ?? '',
		    'goodsCode'=>$param['goodsCode'] ?? '',
		    'goodsNum'=>$param['goodsNum'] ?? '',
		];
		$model = new GameDailyTaskPointRewardModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Common/Task/GameDailyTaskPointReward/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="rewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 * @Param(name="type",alias="1每日奖励,2每周奖励",description="1每日奖励,2每周奖励",lengthMax="255",optional="")
	 * @Param(name="pointNum",alias="积分数",description="积分数",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsNum",alias="物品数量",description="物品数量",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskPointRewardModel();
		$info = $model->get(['rewardId' => $param['rewardId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['pointNum']=$param['pointNum'] ?? $info->pointNum;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['goodsNum']=$param['goodsNum'] ?? $info->goodsNum;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Common/Task/GameDailyTaskPointReward/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="rewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.rewardId",description="奖励id")
	 * @ApiSuccessParam(name="result.type",description="1每日奖励,2每周奖励")
	 * @ApiSuccessParam(name="result.pointNum",description="积分数")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result.goodsNum",description="物品数量")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskPointRewardModel();
		$info = $model->get(['rewardId' => $param['rewardId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Common/Task/GameDailyTaskPointReward/getList")
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
	 * @ApiSuccessParam(name="result[].rewardId",description="奖励id")
	 * @ApiSuccessParam(name="result[].type",description="1每日奖励,2每周奖励")
	 * @ApiSuccessParam(name="result[].pointNum",description="积分数")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result[].goodsNum",description="物品数量")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GameDailyTaskPointRewardModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Common/Task/GameDailyTaskPointReward/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="rewardId",alias="奖励id",description="奖励id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameDailyTaskPointRewardModel();
		$info = $model->get(['rewardId' => $param['rewardId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

