<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\UserGoodsEquipmentStrengthenAttributeModel;
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
 * UserGoodsEquipmentStrengthenAttribute
 * Class UserGoodsEquipmentStrengthenAttribute
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.UserGoodsEquipmentStrengthenAttribute")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserGoodsEquipmentStrengthenAttribute extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/UserGoodsEquipmentStrengthenAttribute/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userEquipmentBackpackId",alias="用户装备id",description="用户装备id",lengthMax="11",required="")
	 * @Param(name="strengthenLevel",alias="强化等级",description="强化等级",lengthMax="255",optional="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="255",optional="")
	 * @Param(name="attack",alias="攻击",description="攻击",lengthMax="255",optional="")
	 * @Param(name="defense",alias="防御",description="防御",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userEquipmentBackpackId'=>$param['userEquipmentBackpackId'],
		    'strengthenLevel'=>$param['strengthenLevel'] ?? '',
		    'hp'=>$param['hp'] ?? '',
		    'attack'=>$param['attack'] ?? '',
		    'defense'=>$param['defense'] ?? '',
		];
		$model = new UserGoodsEquipmentStrengthenAttributeModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/UserGoodsEquipmentStrengthenAttribute/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userEquipmentBackpackId",alias="用户装备id",description="用户装备id",lengthMax="11",required="")
	 * @Param(name="strengthenLevel",alias="强化等级",description="强化等级",lengthMax="255",optional="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="255",optional="")
	 * @Param(name="attack",alias="攻击",description="攻击",lengthMax="255",optional="")
	 * @Param(name="defense",alias="防御",description="防御",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$info = $model->get(['userEquipmentBackpackId' => $param['userEquipmentBackpackId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['strengthenLevel']=$param['strengthenLevel'] ?? $info->strengthenLevel;
		$updateData['hp']=$param['hp'] ?? $info->hp;
		$updateData['attack']=$param['attack'] ?? $info->attack;
		$updateData['defense']=$param['defense'] ?? $info->defense;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/UserGoodsEquipmentStrengthenAttribute/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userEquipmentBackpackId",alias="用户装备id",description="用户装备id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userEquipmentBackpackId",description="用户装备id")
	 * @ApiSuccessParam(name="result.strengthenLevel",description="强化等级")
	 * @ApiSuccessParam(name="result.hp",description="血量")
	 * @ApiSuccessParam(name="result.attack",description="攻击")
	 * @ApiSuccessParam(name="result.defense",description="防御")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$info = $model->get(['userEquipmentBackpackId' => $param['userEquipmentBackpackId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/UserGoodsEquipmentStrengthenAttribute/getList")
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
	 * @ApiSuccessParam(name="result[].userEquipmentBackpackId",description="用户装备id")
	 * @ApiSuccessParam(name="result[].strengthenLevel",description="强化等级")
	 * @ApiSuccessParam(name="result[].hp",description="血量")
	 * @ApiSuccessParam(name="result[].attack",description="攻击")
	 * @ApiSuccessParam(name="result[].defense",description="防御")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/UserGoodsEquipmentStrengthenAttribute/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userEquipmentBackpackId",alias="用户装备id",description="用户装备id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$info = $model->get(['userEquipmentBackpackId' => $param['userEquipmentBackpackId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

