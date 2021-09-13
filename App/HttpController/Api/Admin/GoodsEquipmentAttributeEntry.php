<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\GoodsEquipmentAttributeEntryModel;
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
 * GoodsEquipmentAttributeEntry
 * Class GoodsEquipmentAttributeEntry
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.GoodsEquipmentAttributeEntry")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GoodsEquipmentAttributeEntry extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/GoodsEquipmentAttributeEntry/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",required="")
	 * @Param(name="name",alias="词条名",description="词条名",lengthMax="255",optional="")
	 * @Param(name="equipmentEntryType",alias="装备词条类型 0通用 1防具 2武器 3首饰 4称号",description="装备词条类型 0通用 1防具 2武器 3首饰 4称号",lengthMax="1",optional="")
	 * @Param(name="baseCode",alias="基础词条code",description="基础词条code",lengthMax="32",optional="")
	 * @Param(name="level",alias="词条等级",description="词条等级",lengthMax="11",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="odds",alias="随机概率",description="随机概率",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'code'=>$param['code'],
		    'name'=>$param['name'] ?? '',
		    'equipmentEntryType'=>$param['equipmentEntryType'] ?? '',
		    'baseCode'=>$param['baseCode'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'param'=>$param['param'] ?? '',
		    'odds'=>$param['odds'] ?? '',
		];
		$model = new GoodsEquipmentAttributeEntryModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/GoodsEquipmentAttributeEntry/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",required="")
	 * @Param(name="name",alias="词条名",description="词条名",lengthMax="255",optional="")
	 * @Param(name="equipmentEntryType",alias="装备词条类型 0通用 1防具 2武器 3首饰 4称号",description="装备词条类型 0通用 1防具 2武器 3首饰 4称号",lengthMax="1",optional="")
	 * @Param(name="baseCode",alias="基础词条code",description="基础词条code",lengthMax="32",optional="")
	 * @Param(name="level",alias="词条等级",description="词条等级",lengthMax="11",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="odds",alias="随机概率",description="随机概率",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsEquipmentAttributeEntryModel();
		$info = $model->get(['code' => $param['code']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['equipmentEntryType']=$param['equipmentEntryType'] ?? $info->equipmentEntryType;
		$updateData['baseCode']=$param['baseCode'] ?? $info->baseCode;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['param']=$param['param'] ?? $info->param;
		$updateData['odds']=$param['odds'] ?? $info->odds;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/GoodsEquipmentAttributeEntry/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",required="")
	 * @ApiSuccessParam(name="result.code",description="词条code")
	 * @ApiSuccessParam(name="result.name",description="词条名")
	 * @ApiSuccessParam(name="result.equipmentEntryType",description="装备词条类型 0通用 1防具 2武器 3首饰 4称号")
	 * @ApiSuccessParam(name="result.baseCode",description="基础词条code")
	 * @ApiSuccessParam(name="result.level",description="词条等级")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 * @ApiSuccessParam(name="result.param",description="参数")
	 * @ApiSuccessParam(name="result.odds",description="随机概率")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsEquipmentAttributeEntryModel();
		$info = $model->get(['code' => $param['code']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/GoodsEquipmentAttributeEntry/getList")
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
	 * @ApiSuccessParam(name="result[].code",description="词条code")
	 * @ApiSuccessParam(name="result[].name",description="词条名")
	 * @ApiSuccessParam(name="result[].equipmentEntryType",description="装备词条类型 0通用 1防具 2武器 3首饰 4称号")
	 * @ApiSuccessParam(name="result[].baseCode",description="基础词条code")
	 * @ApiSuccessParam(name="result[].level",description="词条等级")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 * @ApiSuccessParam(name="result[].param",description="参数")
	 * @ApiSuccessParam(name="result[].odds",description="随机概率")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GoodsEquipmentAttributeEntryModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/GoodsEquipmentAttributeEntry/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="code",alias="词条code",description="词条code",lengthMax="255",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsEquipmentAttributeEntryModel();
		$info = $model->get(['code' => $param['code']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

