<?php

namespace App\HttpController\Api\User;

use App\Model\Game\MapEnvironmentModel;
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
 * @ApiGroup(groupName="地图")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Map extends UserBase
{
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
	 * @Api(name="获取所有地图信息",path="/Api/User/Map/getList")
	 * @ApiDescription("获取数据列表")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[{"mapEnvironmentId":1,"name":"一号洞穴","description":"一号洞穴作为最外围的探险区域,相对比较安全....","recommendedLevelValue":"1-25","isInstanceZone":0,"order":null,"mapList":[{"mapId":3,"name":"变异村庄","mapEnvironmentId":1,"difficultyLevel":1,"description":"变异村庄","recommendedLevel":10,"isInstanceZone":0,"maxLevel":10,"monsterNum":5,"exp":1000,"gold":1000,"material":10,"equipment":10,"pet":10,"prop":10,"order":1,"mapIsOpen":0},{"mapId":4,"name":"一号深处","mapEnvironmentId":1,"difficultyLevel":1,"description":"一号深处","recommendedLevel":15,"isInstanceZone":0,"maxLevel":10,"monsterNum":5,"exp":2000,"gold":2000,"material":10,"equipment":10,"pet":10,"prop":10,"order":1,"mapIsOpen":0},{"mapId":1,"name":"哥布林部落","mapEnvironmentId":1,"difficultyLevel":1,"description":"哥布林部落","recommendedLevel":1,"isInstanceZone":0,"maxLevel":10,"monsterNum":5,"exp":100,"gold":100,"material":10,"equipment":10,"pet":10,"prop":10,"order":1,"mapIsOpen":1},{"mapId":2,"name":"矮人洞穴","mapEnvironmentId":1,"difficultyLevel":1,"description":"矮人洞穴","recommendedLevel":5,"isInstanceZone":0,"maxLevel":10,"monsterNum":5,"exp":500,"gold":500,"material":10,"equipment":10,"pet":10,"prop":10,"order":1,"mapIsOpen":0}]}],"msg":"获取列表成功","requestId":null})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="isInstanceZone", from={GET,POST}, alias="是否为副本",inArray={0,1}, required="")
	 * @Param(name="page", from={GET,POST}, alias="页数", optional="")
	 * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].mapEnvironmentId",description="环境id")
     * @ApiSuccessParam(name="result[].name",description="环境名")
     * @ApiSuccessParam(name="result[].description",description="环境介绍")
     * @ApiSuccessParam(name="result[].recommendedLevelValue",description="建议等级")
     * @ApiSuccessParam(name="result[].isInstanceZone",description="是否为副本")
     * @ApiSuccessParam(name="result[].order",description="环境排序")
	 * @ApiSuccessParam(name="result[].mapList.[].mapId",description="地图id")
	 * @ApiSuccessParam(name="result[].mapList.[].name",description="地图名")
	 * @ApiSuccessParam(name="result[].mapList.[].description",description="地图介绍")
	 * @ApiSuccessParam(name="result[].mapList.[].recommendedLevel",description="建议等级")
	 * @ApiSuccessParam(name="result[].mapList.[].isInstanceZone",description="是否为副本")
	 * @ApiSuccessParam(name="result[].mapList.[].exp",description="经验基数")
	 * @ApiSuccessParam(name="result[].mapList.[].gold",description="金币基数")
	 * @ApiSuccessParam(name="result[].mapList.[].material",description="材料基数")
	 * @ApiSuccessParam(name="result[].mapList.[].equipment",description="装备基数")
	 * @ApiSuccessParam(name="result[].mapList.[].pet",description="宠物基数")
	 * @ApiSuccessParam(name="result[].mapList.[].prop",description="道具基数")
	 * @ApiSuccessParam(name="result[].mapList.[].order",description="排序")
	 * @ApiSuccessParam(name="result[].mapList.[].mapIsOpen",description="是否对玩家开放")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		//获取地图环境信息
        $mapEnvironmentList = MapEnvironmentModel::create()->with(['mapList'=>$this->who->userId],false)->order('`order`','ASC')->where('isInstanceZone',$param['isInstanceZone'])->all();

		$this->writeJson(Status::CODE_OK, $mapEnvironmentList, '获取列表成功');
	}

}

