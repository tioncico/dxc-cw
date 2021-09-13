<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserGoodsEquipmentAttributeEntryModel;
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
 * UserGoodsEquipmentAttributeEntry
 * Class UserGoodsEquipmentAttributeEntry
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserGoodsEquipmentAttributeEntry")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserGoodsEquipmentAttributeEntry extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/UserGoodsEquipmentAttributeEntry/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="id",lengthMax="11",required="")
	 * @Param(name="backpackId",lengthMax="11",optional="")
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="baseCode",alias="基础词条code",description="基础词条code",lengthMax="255",optional="")
	 * @Param(name="name",alias="词条名",description="词条名",lengthMax="255",optional="")
	 * @Param(name="level",alias="词条等级",description="词条等级",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字",description="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'id'=>$param['id'],
		    'backpackId'=>$param['backpackId'] ?? '',
		    'code'=>$param['code'] ?? '',
		    'baseCode'=>$param['baseCode'] ?? '',
		    'name'=>$param['name'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'param'=>$param['param'] ?? '',
		];
		$model = new UserGoodsEquipmentAttributeEntryModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/UserGoodsEquipmentAttributeEntry/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="id",lengthMax="11",required="")
	 * @Param(name="backpackId",lengthMax="11",optional="")
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="baseCode",alias="基础词条code",description="基础词条code",lengthMax="255",optional="")
	 * @Param(name="name",alias="词条名",description="词条名",lengthMax="255",optional="")
	 * @Param(name="level",alias="词条等级",description="词条等级",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字",description="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['backpackId']=$param['backpackId'] ?? $info->backpackId;
		$updateData['code']=$param['code'] ?? $info->code;
		$updateData['baseCode']=$param['baseCode'] ?? $info->baseCode;
		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['param']=$param['param'] ?? $info->param;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserGoodsEquipmentAttributeEntry/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.id",description="")
	 * @ApiSuccessParam(name="result.backpackId",description="")
	 * @ApiSuccessParam(name="result.code",description="词条code")
	 * @ApiSuccessParam(name="result.baseCode",description="基础词条code")
	 * @ApiSuccessParam(name="result.name",description="词条名")
	 * @ApiSuccessParam(name="result.level",description="词条等级")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 * @ApiSuccessParam(name="result.param",description="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$info = $model->get(['id' => $param['id']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/UserGoodsEquipmentAttributeEntry/getList")
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
	 * @ApiSuccessParam(name="result[].id",description="")
	 * @ApiSuccessParam(name="result[].backpackId",description="")
	 * @ApiSuccessParam(name="result[].code",description="词条code")
	 * @ApiSuccessParam(name="result[].baseCode",description="基础词条code")
	 * @ApiSuccessParam(name="result[].name",description="词条名")
	 * @ApiSuccessParam(name="result[].level",description="词条等级")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 * @ApiSuccessParam(name="result[].param",description="参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/UserGoodsEquipmentAttributeEntry/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$info = $model->get(['id' => $param['id']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

