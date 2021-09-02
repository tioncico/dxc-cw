<?php

namespace App\HttpController\Api\User;

use App\Model\Game\AttributeEntryModel;
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
 * AttributeEntry
 * Class AttributeEntry
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.AttributeEntry")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class AttributeEntry extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/AttributeEntry/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="entryId",alias="词条id",description="词条id",lengthMax="11",required="")
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",required="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",required="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'entryId'=>$param['entryId'],
		    'code'=>$param['code'],
		    'description'=>$param['description'],
		];
		$model = new AttributeEntryModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/AttributeEntry/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="entryId",alias="词条id",description="词条id",lengthMax="11",required="")
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AttributeEntryModel();
		$info = $model->get(['entryId' => $param['entryId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['code']=$param['code'] ?? $info->code;
		$updateData['description']=$param['description'] ?? $info->description;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/AttributeEntry/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="entryId",alias="词条id",description="词条id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.entryId",description="词条id")
	 * @ApiSuccessParam(name="result.code",description="词条code")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AttributeEntryModel();
		$info = $model->get(['entryId' => $param['entryId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/AttributeEntry/getList")
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
	 * @ApiSuccessParam(name="result[].entryId",description="词条id")
	 * @ApiSuccessParam(name="result[].code",description="词条code")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new AttributeEntryModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/AttributeEntry/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="entryId",alias="词条id",description="词条id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AttributeEntryModel();
		$info = $model->get(['entryId' => $param['entryId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

