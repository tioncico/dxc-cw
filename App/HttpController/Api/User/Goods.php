<?php

namespace App\HttpController\Api\User;

use App\Model\Game\GoodsModel;
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
 * Goods
 * Class Goods
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.Goods")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Goods extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Goods/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="goodsId",alias="物品id",description="物品id",lengthMax="11",required="")
	 * @Param(name="name",alias="物品名称",description="物品名称",lengthMax="255",optional="")
	 * @Param(name="code",alias="物品code值",description="物品code值",lengthMax="255",optional="")
	 * @Param(name="baseCode",alias="物品基础类型",description="物品基础类型",lengthMax="255",optional="")
	 * @Param(name="type",alias="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="gold",alias="售出金币",description="售出金币",lengthMax="255",optional="")
	 * @Param(name="isSale",alias="是否可售出",description="是否可售出",lengthMax="255",optional="")
	 * @Param(name="level",alias="等级",description="等级",lengthMax="255",optional="")
	 * @Param(name="rarityLevel",alias="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="255",optional="")
	 * @Param(name="extraData",alias="额外数据",description="额外数据",lengthMax="255",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'goodsId'=>$param['goodsId'],
		    'name'=>$param['name'] ?? '',
		    'code'=>$param['code'] ?? '',
		    'baseCode'=>$param['baseCode'] ?? '',
		    'type'=>$param['type'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'gold'=>$param['gold'] ?? '',
		    'isSale'=>$param['isSale'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'rarityLevel'=>$param['rarityLevel'] ?? '',
		    'extraData'=>$param['extraData'] ?? '',
		];
		$model = new GoodsModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Goods/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="goodsId",alias="物品id",description="物品id",lengthMax="11",required="")
	 * @Param(name="name",alias="物品名称",description="物品名称",lengthMax="255",optional="")
	 * @Param(name="code",alias="物品code值",description="物品code值",lengthMax="255",optional="")
	 * @Param(name="baseCode",alias="物品基础类型",description="物品基础类型",lengthMax="255",optional="")
	 * @Param(name="type",alias="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 * @Param(name="gold",alias="售出金币",description="售出金币",lengthMax="255",optional="")
	 * @Param(name="isSale",alias="是否可售出",description="是否可售出",lengthMax="255",optional="")
	 * @Param(name="level",alias="等级",description="等级",lengthMax="255",optional="")
	 * @Param(name="rarityLevel",alias="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="255",optional="")
	 * @Param(name="extraData",alias="额外数据",description="额外数据",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsModel();
		$info = $model->get(['goodsId' => $param['goodsId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['code']=$param['code'] ?? $info->code;
		$updateData['baseCode']=$param['baseCode'] ?? $info->baseCode;
		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['gold']=$param['gold'] ?? $info->gold;
		$updateData['isSale']=$param['isSale'] ?? $info->isSale;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['rarityLevel']=$param['rarityLevel'] ?? $info->rarityLevel;
		$updateData['extraData']=$param['extraData'] ?? $info->extraData;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Goods/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="goodsId",alias="物品id",description="物品id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.goodsId",description="物品id")
	 * @ApiSuccessParam(name="result.name",description="物品名称")
	 * @ApiSuccessParam(name="result.code",description="物品code值")
	 * @ApiSuccessParam(name="result.baseCode",description="物品基础类型")
	 * @ApiSuccessParam(name="result.type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 * @ApiSuccessParam(name="result.gold",description="售出金币")
	 * @ApiSuccessParam(name="result.isSale",description="是否可售出")
	 * @ApiSuccessParam(name="result.level",description="等级")
	 * @ApiSuccessParam(name="result.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result.extraData",description="额外数据")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsModel();
		$info = $model->get(['goodsId' => $param['goodsId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/Goods/getList")
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
	 * @ApiSuccessParam(name="result[].goodsId",description="物品id")
	 * @ApiSuccessParam(name="result[].name",description="物品名称")
	 * @ApiSuccessParam(name="result[].code",description="物品code值")
	 * @ApiSuccessParam(name="result[].baseCode",description="物品基础类型")
	 * @ApiSuccessParam(name="result[].type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 * @ApiSuccessParam(name="result[].gold",description="售出金币")
	 * @ApiSuccessParam(name="result[].isSale",description="是否可售出")
	 * @ApiSuccessParam(name="result[].level",description="等级")
	 * @ApiSuccessParam(name="result[].rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result[].extraData",description="额外数据")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new GoodsModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Goods/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="goodsId",alias="物品id",description="物品id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new GoodsModel();
		$info = $model->get(['goodsId' => $param['goodsId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

