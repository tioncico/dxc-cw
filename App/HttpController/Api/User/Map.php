<?php

namespace App\HttpController\Api\User;

use App\Model\Game\MapModel;
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
 * Map
 * Class Map
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.Map")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Map extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Map/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",required="")
	 * @Param(name="name",alias="地图名",description="地图名",lengthMax="255",required="")
	 * @Param(name="description",alias="地图介绍",description="地图介绍",lengthMax="255",required="")
	 * @Param(name="recommendedLevel",alias="建议等级",description="建议等级",lengthMax="255",required="")
	 * @Param(name="isInstanceZone",alias="是否为副本",description="是否为副本",lengthMax="255",required="")
	 * @Param(name="maxLevel",alias="最大层数",description="最大层数",lengthMax="255",required="")
	 * @Param(name="monsterNum",alias="每层怪物数量",description="每层怪物数量",lengthMax="255",required="")
	 * @Param(name="exp",alias="经验基数",description="经验基数",lengthMax="255",required="")
	 * @Param(name="gold",alias="金币基数",description="金币基数",lengthMax="255",required="")
	 * @Param(name="material",alias="材料基数",description="材料基数",lengthMax="255",required="")
	 * @Param(name="equipment",alias="装备基数",description="装备基数",lengthMax="255",required="")
	 * @Param(name="pet",alias="宠物基数",description="宠物基数",lengthMax="255",required="")
	 * @Param(name="prop",alias="道具基数",description="道具基数",lengthMax="255",required="")
	 * @Param(name="order",alias="排序",description="排序",lengthMax="255",required="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'mapId'=>$param['mapId'],
		    'name'=>$param['name'],
		    'description'=>$param['description'],
		    'recommendedLevel'=>$param['recommendedLevel'],
		    'isInstanceZone'=>$param['isInstanceZone'],
		    'exp'=>$param['exp'],
		    'gold'=>$param['gold'],
		    'material'=>$param['material'],
		    'equipment'=>$param['equipment'],
		    'pet'=>$param['pet'],
		    'prop'=>$param['prop'],
		    'order'=>$param['order'],
		];
		$model = new MapModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Map/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",required="")
	 * @Param(name="name",alias="地图名",description="地图名",lengthMax="255",optional="")
	 * @Param(name="description",alias="地图介绍",description="地图介绍",lengthMax="255",optional="")
	 * @Param(name="recommendedLevel",alias="建议等级",description="建议等级",lengthMax="255",optional="")
	 * @Param(name="isInstanceZone",alias="是否为副本",description="是否为副本",lengthMax="255",optional="")
	 * @Param(name="exp",alias="经验基数",description="经验基数",lengthMax="255",optional="")
	 * @Param(name="gold",alias="金币基数",description="金币基数",lengthMax="255",optional="")
	 * @Param(name="material",alias="材料基数",description="材料基数",lengthMax="255",optional="")
	 * @Param(name="equipment",alias="装备基数",description="装备基数",lengthMax="255",optional="")
	 * @Param(name="pet",alias="宠物基数",description="宠物基数",lengthMax="255",optional="")
	 * @Param(name="prop",alias="道具基数",description="道具基数",lengthMax="255",optional="")
	 * @Param(name="order",alias="排序",description="排序",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapModel();
		$info = $model->get(['mapId' => $param['mapId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['recommendedLevel']=$param['recommendedLevel'] ?? $info->recommendedLevel;
		$updateData['isInstanceZone']=$param['isInstanceZone'] ?? $info->isInstanceZone;
		$updateData['exp']=$param['exp'] ?? $info->exp;
		$updateData['gold']=$param['gold'] ?? $info->gold;
		$updateData['material']=$param['material'] ?? $info->material;
		$updateData['equipment']=$param['equipment'] ?? $info->equipment;
		$updateData['pet']=$param['pet'] ?? $info->pet;
		$updateData['prop']=$param['prop'] ?? $info->prop;
		$updateData['order']=$param['order'] ?? $info->order;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Map/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.mapId",description="地图id")
	 * @ApiSuccessParam(name="result.name",description="地图名")
	 * @ApiSuccessParam(name="result.description",description="地图介绍")
	 * @ApiSuccessParam(name="result.recommendedLevel",description="建议等级")
	 * @ApiSuccessParam(name="result.isInstanceZone",description="是否为副本")
	 * @ApiSuccessParam(name="result.exp",description="经验基数")
	 * @ApiSuccessParam(name="result.gold",description="金币基数")
	 * @ApiSuccessParam(name="result.material",description="材料基数")
	 * @ApiSuccessParam(name="result.equipment",description="装备基数")
	 * @ApiSuccessParam(name="result.pet",description="宠物基数")
	 * @ApiSuccessParam(name="result.prop",description="道具基数")
	 * @ApiSuccessParam(name="result.order",description="排序")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapModel();
		$info = $model->get(['mapId' => $param['mapId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/Map/getList")
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
	 * @ApiSuccessParam(name="result[].mapId",description="地图id")
	 * @ApiSuccessParam(name="result[].name",description="地图名")
	 * @ApiSuccessParam(name="result[].description",description="地图介绍")
	 * @ApiSuccessParam(name="result[].recommendedLevel",description="建议等级")
	 * @ApiSuccessParam(name="result[].isInstanceZone",description="是否为副本")
	 * @ApiSuccessParam(name="result[].exp",description="经验基数")
	 * @ApiSuccessParam(name="result[].gold",description="金币基数")
	 * @ApiSuccessParam(name="result[].material",description="材料基数")
	 * @ApiSuccessParam(name="result[].equipment",description="装备基数")
	 * @ApiSuccessParam(name="result[].pet",description="宠物基数")
	 * @ApiSuccessParam(name="result[].prop",description="道具基数")
	 * @ApiSuccessParam(name="result[].order",description="排序")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new MapModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Map/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="mapId",alias="地图id",description="地图id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MapModel();
		$info = $model->get(['mapId' => $param['mapId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

