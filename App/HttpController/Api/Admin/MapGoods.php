<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\MapGoodsModel;
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
 * MapGoods
 * Class MapGoods
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.MapGoods")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class MapGoods extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/MapGoods/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapGoodsId",lengthMax="11",required="")
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品id",description="物品id",lengthMax="255",optional="")
	 * @Param(name="goodsType",alias="物品类型",description="物品类型",lengthMax="11",optional="")
	 * @Param(name="odds",alias="爆率",description="爆率",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'mapGoodsId'=>$param['mapGoodsId'],
		    'mapId'=>$param['mapId'] ?? '',
		    'goodsCode'=>$param['goodsCode'] ?? '',
		    'goodsType'=>$param['goodsType'] ?? '',
		    'odds'=>$param['odds'] ?? '',
		];
		$model = new MapGoodsModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/MapGoods/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="mapGoodsId",lengthMax="11",required="")
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品id",description="物品id",lengthMax="255",optional="")
	 * @Param(name="goodsType",alias="物品类型",description="物品类型",lengthMax="11",optional="")
	 * @Param(name="odds",alias="爆率",description="爆率",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapGoodsModel();
		$info = $model->get(['mapGoodsId' => $param['mapGoodsId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['mapId']=$param['mapId'] ?? $info->mapId;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['goodsType']=$param['goodsType'] ?? $info->goodsType;
		$updateData['odds']=$param['odds'] ?? $info->odds;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/MapGoods/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="mapGoodsId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.mapGoodsId",description="")
	 * @ApiSuccessParam(name="result.mapId",description="地图id")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品id")
	 * @ApiSuccessParam(name="result.goodsType",description="物品类型")
	 * @ApiSuccessParam(name="result.odds",description="爆率")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapGoodsModel();
		$info = $model->get(['mapGoodsId' => $param['mapGoodsId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/MapGoods/getList")
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
	 * @ApiSuccessParam(name="result[].mapGoodsId",description="")
	 * @ApiSuccessParam(name="result[].mapId",description="地图id")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品id")
	 * @ApiSuccessParam(name="result[].goodsType",description="物品类型")
	 * @ApiSuccessParam(name="result[].odds",description="爆率")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new MapGoodsModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/MapGoods/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapGoodsId",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapGoodsModel();
		$info = $model->get(['mapGoodsId' => $param['mapGoodsId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

