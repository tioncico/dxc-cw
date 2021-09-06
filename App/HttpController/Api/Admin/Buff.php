<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\BuffModel;
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
 * Buff
 * Class Buff
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.Buff")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Buff extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Buff/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="buffId",lengthMax="11",required="")
	 * @Param(name="name",alias="buff名称",description="buff名称",lengthMax="255",optional="")
	 * @Param(name="code",alias="buffcode",description="buffcode",lengthMax="255",optional="")
	 * @Param(name="stackLayer",alias="最大叠加层数",description="最大叠加层数",lengthMax="11",optional="")
	 * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="type",alias="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="11",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'buffId'=>$param['buffId'],
		    'name'=>$param['name'] ?? '',
		    'code'=>$param['code'] ?? '',
		    'stackLayer'=>$param['stackLayer'] ?? '',
		    'entryCode'=>$param['entryCode'] ?? '',
		    'param'=>$param['param'] ?? '',
		    'type'=>$param['type'] ?? '',
		    'description'=>$param['description'] ?? '',
		];
		$model = new BuffModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Buff/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="buffId",lengthMax="11",required="")
	 * @Param(name="name",alias="buff名称",description="buff名称",lengthMax="255",optional="")
	 * @Param(name="code",alias="buffcode",description="buffcode",lengthMax="255",optional="")
	 * @Param(name="stackLayer",alias="最大叠加层数",description="最大叠加层数",lengthMax="11",optional="")
	 * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="type",alias="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="11",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new BuffModel();
		$info = $model->get(['buffId' => $param['buffId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['code']=$param['code'] ?? $info->code;
		$updateData['stackLayer']=$param['stackLayer'] ?? $info->stackLayer;
		$updateData['entryCode']=$param['entryCode'] ?? $info->entryCode;
		$updateData['param']=$param['param'] ?? $info->param;
		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['description']=$param['description'] ?? $info->description;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Buff/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="buffId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.buffId",description="")
	 * @ApiSuccessParam(name="result.name",description="buff名称")
	 * @ApiSuccessParam(name="result.code",description="buffcode")
	 * @ApiSuccessParam(name="result.stackLayer",description="最大叠加层数")
	 * @ApiSuccessParam(name="result.entryCode",description="词条code")
	 * @ApiSuccessParam(name="result.param",description="参数")
	 * @ApiSuccessParam(name="result.type",description="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new BuffModel();
		$info = $model->get(['buffId' => $param['buffId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/Buff/getList")
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
	 * @ApiSuccessParam(name="result[].buffId",description="")
	 * @ApiSuccessParam(name="result[].name",description="buff名称")
	 * @ApiSuccessParam(name="result[].code",description="buffcode")
	 * @ApiSuccessParam(name="result[].stackLayer",description="最大叠加层数")
	 * @ApiSuccessParam(name="result[].entryCode",description="词条code")
	 * @ApiSuccessParam(name="result[].param",description="参数")
	 * @ApiSuccessParam(name="result[].type",description="触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new BuffModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Buff/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="buffId",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new BuffModel();
		$info = $model->get(['buffId' => $param['buffId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

