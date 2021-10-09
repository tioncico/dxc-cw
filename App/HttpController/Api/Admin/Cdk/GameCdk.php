<?php

namespace App\HttpController\Api\Admin\Cdk;

use App\HttpController\Api\Admin\AdminBase;
use App\Model\Game\Cdk\GameCdkModel;
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
 * GameCdk
 * Class GameCdk
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin/Cdk.GameCdk")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameCdk extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Cdk/GameCdk/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="cdk",alias="cdk兑换码",description="cdk兑换码",lengthMax="255",optional="")
	 * @Param(name="num",alias="剩余数量,-1表示无限",description="剩余数量,-1表示无限",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 * @Param(name="endTime",alias="过期时间",description="过期时间",lengthMax="11",optional="")
	 * @Param(name="status",alias="状态 0正常,1已使用 -1已过期",description="状态 0正常,1已使用 -1已过期",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'cdk'=>$param['cdk'] ?? '',
		    'num'=>$param['num'] ?? '',
		    'addTime'=>$param['addTime'] ?? '',
		    'endTime'=>$param['endTime'] ?? '',
		    'status'=>$param['status'] ?? '',
		];
		$model = new GameCdkModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Cdk/GameCdk/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="cdkId",alias="id",description="id",lengthMax="11",required="")
	 * @Param(name="cdk",alias="cdk兑换码",description="cdk兑换码",lengthMax="255",optional="")
	 * @Param(name="num",alias="剩余数量,-1表示无限",description="剩余数量,-1表示无限",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 * @Param(name="endTime",alias="过期时间",description="过期时间",lengthMax="11",optional="")
	 * @Param(name="status",alias="状态 0正常,1已使用 -1已过期",description="状态 0正常,1已使用 -1已过期",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameCdkModel();
		$info = $model->get(['cdkId' => $param['cdkId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['cdk']=$param['cdk'] ?? $info->cdk;
		$updateData['num']=$param['num'] ?? $info->num;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$updateData['endTime']=$param['endTime'] ?? $info->endTime;
		$updateData['status']=$param['status'] ?? $info->status;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Cdk/GameCdk/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="cdkId",alias="id",description="id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.cdkId",description="id")
	 * @ApiSuccessParam(name="result.cdk",description="cdk兑换码")
	 * @ApiSuccessParam(name="result.num",description="剩余数量,-1表示无限")
	 * @ApiSuccessParam(name="result.addTime",description="新增时间")
	 * @ApiSuccessParam(name="result.endTime",description="过期时间")
	 * @ApiSuccessParam(name="result.status",description="状态 0正常,1已使用 -1已过期")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameCdkModel();
		$info = $model->get(['cdkId' => $param['cdkId']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/Cdk/GameCdk/getList")
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
	 * @ApiSuccessParam(name="result[].cdkId",description="id")
	 * @ApiSuccessParam(name="result[].cdk",description="cdk兑换码")
	 * @ApiSuccessParam(name="result[].num",description="剩余数量,-1表示无限")
	 * @ApiSuccessParam(name="result[].addTime",description="新增时间")
	 * @ApiSuccessParam(name="result[].endTime",description="过期时间")
	 * @ApiSuccessParam(name="result[].status",description="状态 0正常,1已使用 -1已过期")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GameCdkModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Cdk/GameCdk/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="cdkId",alias="id",description="id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GameCdkModel();
		$info = $model->get(['cdkId' => $param['cdkId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

