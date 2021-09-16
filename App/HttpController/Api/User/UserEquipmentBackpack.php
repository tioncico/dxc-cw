<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserEquipmentBackpackModel;
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
 * UserEquipmentBackpack
 * Class UserEquipmentBackpack
 * Create With ClassGeneration
 * @ApiGroup(groupName="用户装备")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserEquipmentBackpack extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/UserEquipmentBackpack/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="backpackId",alias="背包id",description="背包id",lengthMax="11",required="")
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
	 * @Param(name="isUse",alias="是否使用",description="是否使用",lengthMax="1",optional="",defaultValue="0")
	 * @Param(name="strengthenLevel",alias="强化等级",description="强化等级",lengthMax="11",optional="")
	 * @Param(name="attributeDescription",alias="属性介绍",description="属性介绍",lengthMax="255",optional="")
	 * @Param(name="attributeEntryDescription",alias="随机属性介绍",description="随机属性介绍",lengthMax="255",optional="")
	 * @Param(name="extraAttributeDescription",alias="额外词条属性介绍",description="额外词条属性介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute2Description",alias="套装2属性词条介绍",description="套装2属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute3Description",alias="套装3属性词条介绍",description="套装3属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute5Description",alias="套装5属性词条介绍",description="套装5属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsName",alias="物品名",description="物品名",lengthMax="255",optional="")
	 * @Param(name="equipmentType",alias="装备类型",description="装备类型",lengthMax="1",optional="")
	 * @Param(name="suitCode",alias="套装code",description="套装code",lengthMax="255",optional="")
	 * @Param(name="rarityLevel",alias="稀有度",description="稀有度",lengthMax="11",optional="")
	 * @Param(name="level",alias="装备等级",description="装备等级",lengthMax="11",optional="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="11",optional="")
	 * @Param(name="mp",alias="法力值",description="法力值",lengthMax="11",optional="")
	 * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",optional="")
	 * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",optional="")
	 * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",optional="")
	 * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",optional="")
	 * @Param(name="strength",alias="力量",description="力量",lengthMax="11",optional="")
	 * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",optional="")
	 * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",optional="")
	 * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",optional="")
	 * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
	 * @Param(name="penetrate",alias="穿透",description="穿透",lengthMax="11",optional="")
	 * @Param(name="attackSpeed",alias="攻击速度",description="攻击速度",lengthMax="11",optional="")
	 * @Param(name="userElement",alias="角色元素",description="角色元素",lengthMax="11",optional="")
	 * @Param(name="attackElement",alias="攻击元素",description="攻击元素",lengthMax="11",optional="")
	 * @Param(name="jin",alias="金",description="金",lengthMax="11",optional="")
	 * @Param(name="mu",alias="木",description="木",lengthMax="11",optional="")
	 * @Param(name="tu",alias="土",description="土",lengthMax="11",optional="")
	 * @Param(name="sui",alias="水",description="水",lengthMax="11",optional="")
	 * @Param(name="huo",alias="火",description="火",lengthMax="11",optional="")
	 * @Param(name="light",alias="光",description="光",lengthMax="11",optional="")
	 * @Param(name="dark",alias="暗",description="暗",lengthMax="11",optional="")
	 * @Param(name="luck",alias="幸运值",description="幸运值",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'backpackId'=>$param['backpackId'],
		    'userId'=>$param['userId'] ?? '',
		    'isUse'=>$param['isUse'] ?? '',
		    'strengthenLevel'=>$param['strengthenLevel'] ?? '',
		    'attributeDescription'=>$param['attributeDescription'] ?? '',
		    'attributeEntryDescription'=>$param['attributeEntryDescription'] ?? '',
		    'extraAttributeDescription'=>$param['extraAttributeDescription'] ?? '',
		    'suitAttribute2Description'=>$param['suitAttribute2Description'] ?? '',
		    'suitAttribute3Description'=>$param['suitAttribute3Description'] ?? '',
		    'suitAttribute5Description'=>$param['suitAttribute5Description'] ?? '',
		    'goodsCode'=>$param['goodsCode'] ?? '',
		    'goodsName'=>$param['goodsName'] ?? '',
		    'equipmentType'=>$param['equipmentType'] ?? '',
		    'suitCode'=>$param['suitCode'] ?? '',
		    'rarityLevel'=>$param['rarityLevel'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'hp'=>$param['hp'] ?? '',
		    'mp'=>$param['mp'] ?? '',
		    'attack'=>$param['attack'] ?? '',
		    'defense'=>$param['defense'] ?? '',
		    'endurance'=>$param['endurance'] ?? '',
		    'intellect'=>$param['intellect'] ?? '',
		    'strength'=>$param['strength'] ?? '',
		    'criticalRate'=>$param['criticalRate'] ?? '',
		    'criticalStrikeDamage'=>$param['criticalStrikeDamage'] ?? '',
		    'hitRate'=>$param['hitRate'] ?? '',
		    'dodgeRate'=>$param['dodgeRate'] ?? '',
		    'penetrate'=>$param['penetrate'] ?? '',
		    'attackSpeed'=>$param['attackSpeed'] ?? '',
		    'userElement'=>$param['userElement'] ?? '',
		    'attackElement'=>$param['attackElement'] ?? '',
		    'jin'=>$param['jin'] ?? '',
		    'mu'=>$param['mu'] ?? '',
		    'tu'=>$param['tu'] ?? '',
		    'sui'=>$param['sui'] ?? '',
		    'huo'=>$param['huo'] ?? '',
		    'light'=>$param['light'] ?? '',
		    'dark'=>$param['dark'] ?? '',
		    'luck'=>$param['luck'] ?? '',
		];
		$model = new UserEquipmentBackpackModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/UserEquipmentBackpack/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="backpackId",alias="背包id",description="背包id",lengthMax="11",required="")
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
	 * @Param(name="isUse",alias="是否使用",description="是否使用",lengthMax="1",optional="",defaultValue="0")
	 * @Param(name="strengthenLevel",alias="强化等级",description="强化等级",lengthMax="11",optional="")
	 * @Param(name="attributeDescription",alias="属性介绍",description="属性介绍",lengthMax="255",optional="")
	 * @Param(name="attributeEntryDescription",alias="随机属性介绍",description="随机属性介绍",lengthMax="255",optional="")
	 * @Param(name="extraAttributeDescription",alias="额外词条属性介绍",description="额外词条属性介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute2Description",alias="套装2属性词条介绍",description="套装2属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute3Description",alias="套装3属性词条介绍",description="套装3属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="suitAttribute5Description",alias="套装5属性词条介绍",description="套装5属性词条介绍",lengthMax="255",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsName",alias="物品名",description="物品名",lengthMax="255",optional="")
	 * @Param(name="equipmentType",alias="装备类型",description="装备类型",lengthMax="1",optional="")
	 * @Param(name="suitCode",alias="套装code",description="套装code",lengthMax="255",optional="")
	 * @Param(name="rarityLevel",alias="稀有度",description="稀有度",lengthMax="11",optional="")
	 * @Param(name="level",alias="装备等级",description="装备等级",lengthMax="11",optional="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="11",optional="")
	 * @Param(name="mp",alias="法力值",description="法力值",lengthMax="11",optional="")
	 * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",optional="")
	 * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",optional="")
	 * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",optional="")
	 * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",optional="")
	 * @Param(name="strength",alias="力量",description="力量",lengthMax="11",optional="")
	 * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",optional="")
	 * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",optional="")
	 * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",optional="")
	 * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
	 * @Param(name="penetrate",alias="穿透",description="穿透",lengthMax="11",optional="")
	 * @Param(name="attackSpeed",alias="攻击速度",description="攻击速度",lengthMax="11",optional="")
	 * @Param(name="userElement",alias="角色元素",description="角色元素",lengthMax="11",optional="")
	 * @Param(name="attackElement",alias="攻击元素",description="攻击元素",lengthMax="11",optional="")
	 * @Param(name="jin",alias="金",description="金",lengthMax="11",optional="")
	 * @Param(name="mu",alias="木",description="木",lengthMax="11",optional="")
	 * @Param(name="tu",alias="土",description="土",lengthMax="11",optional="")
	 * @Param(name="sui",alias="水",description="水",lengthMax="11",optional="")
	 * @Param(name="huo",alias="火",description="火",lengthMax="11",optional="")
	 * @Param(name="light",alias="光",description="光",lengthMax="11",optional="")
	 * @Param(name="dark",alias="暗",description="暗",lengthMax="11",optional="")
	 * @Param(name="luck",alias="幸运值",description="幸运值",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserEquipmentBackpackModel();
		$info = $model->get(['backpackId' => $param['backpackId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['isUse']=$param['isUse'] ?? $info->isUse;
		$updateData['strengthenLevel']=$param['strengthenLevel'] ?? $info->strengthenLevel;
		$updateData['attributeDescription']=$param['attributeDescription'] ?? $info->attributeDescription;
		$updateData['attributeEntryDescription']=$param['attributeEntryDescription'] ?? $info->attributeEntryDescription;
		$updateData['extraAttributeDescription']=$param['extraAttributeDescription'] ?? $info->extraAttributeDescription;
		$updateData['suitAttribute2Description']=$param['suitAttribute2Description'] ?? $info->suitAttribute2Description;
		$updateData['suitAttribute3Description']=$param['suitAttribute3Description'] ?? $info->suitAttribute3Description;
		$updateData['suitAttribute5Description']=$param['suitAttribute5Description'] ?? $info->suitAttribute5Description;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['goodsName']=$param['goodsName'] ?? $info->goodsName;
		$updateData['equipmentType']=$param['equipmentType'] ?? $info->equipmentType;
		$updateData['suitCode']=$param['suitCode'] ?? $info->suitCode;
		$updateData['rarityLevel']=$param['rarityLevel'] ?? $info->rarityLevel;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['hp']=$param['hp'] ?? $info->hp;
		$updateData['mp']=$param['mp'] ?? $info->mp;
		$updateData['attack']=$param['attack'] ?? $info->attack;
		$updateData['defense']=$param['defense'] ?? $info->defense;
		$updateData['endurance']=$param['endurance'] ?? $info->endurance;
		$updateData['intellect']=$param['intellect'] ?? $info->intellect;
		$updateData['strength']=$param['strength'] ?? $info->strength;
		$updateData['criticalRate']=$param['criticalRate'] ?? $info->criticalRate;
		$updateData['criticalStrikeDamage']=$param['criticalStrikeDamage'] ?? $info->criticalStrikeDamage;
		$updateData['hitRate']=$param['hitRate'] ?? $info->hitRate;
		$updateData['dodgeRate']=$param['dodgeRate'] ?? $info->dodgeRate;
		$updateData['penetrate']=$param['penetrate'] ?? $info->penetrate;
		$updateData['attackSpeed']=$param['attackSpeed'] ?? $info->attackSpeed;
		$updateData['userElement']=$param['userElement'] ?? $info->userElement;
		$updateData['attackElement']=$param['attackElement'] ?? $info->attackElement;
		$updateData['jin']=$param['jin'] ?? $info->jin;
		$updateData['mu']=$param['mu'] ?? $info->mu;
		$updateData['tu']=$param['tu'] ?? $info->tu;
		$updateData['sui']=$param['sui'] ?? $info->sui;
		$updateData['huo']=$param['huo'] ?? $info->huo;
		$updateData['light']=$param['light'] ?? $info->light;
		$updateData['dark']=$param['dark'] ?? $info->dark;
		$updateData['luck']=$param['luck'] ?? $info->luck;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserEquipmentBackpack/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="backpackId",alias="背包id",description="背包id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.backpackId",description="背包id")
	 * @ApiSuccessParam(name="result.userId",description="用户id")
	 * @ApiSuccessParam(name="result.isUse",description="是否使用")
	 * @ApiSuccessParam(name="result.strengthenLevel",description="强化等级")
	 * @ApiSuccessParam(name="result.attributeDescription",description="属性介绍")
	 * @ApiSuccessParam(name="result.attributeEntryDescription",description="随机属性介绍")
	 * @ApiSuccessParam(name="result.extraAttributeDescription",description="额外词条属性介绍")
	 * @ApiSuccessParam(name="result.suitAttribute2Description",description="套装2属性词条介绍")
	 * @ApiSuccessParam(name="result.suitAttribute3Description",description="套装3属性词条介绍")
	 * @ApiSuccessParam(name="result.suitAttribute5Description",description="套装5属性词条介绍")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result.goodsName",description="物品名")
	 * @ApiSuccessParam(name="result.equipmentType",description="装备类型")
	 * @ApiSuccessParam(name="result.suitCode",description="套装code")
	 * @ApiSuccessParam(name="result.rarityLevel",description="稀有度")
	 * @ApiSuccessParam(name="result.level",description="装备等级")
	 * @ApiSuccessParam(name="result.hp",description="血量")
	 * @ApiSuccessParam(name="result.mp",description="法力值")
	 * @ApiSuccessParam(name="result.attack",description="攻击力")
	 * @ApiSuccessParam(name="result.defense",description="防御力")
	 * @ApiSuccessParam(name="result.endurance",description="耐力")
	 * @ApiSuccessParam(name="result.intellect",description="智力")
	 * @ApiSuccessParam(name="result.strength",description="力量")
	 * @ApiSuccessParam(name="result.criticalRate",description="暴击率")
	 * @ApiSuccessParam(name="result.criticalStrikeDamage",description="暴击伤害")
	 * @ApiSuccessParam(name="result.hitRate",description="命中率")
	 * @ApiSuccessParam(name="result.dodgeRate",description="闪避率")
	 * @ApiSuccessParam(name="result.penetrate",description="穿透")
	 * @ApiSuccessParam(name="result.attackSpeed",description="攻击速度")
	 * @ApiSuccessParam(name="result.userElement",description="角色元素")
	 * @ApiSuccessParam(name="result.attackElement",description="攻击元素")
	 * @ApiSuccessParam(name="result.jin",description="金")
	 * @ApiSuccessParam(name="result.mu",description="木")
	 * @ApiSuccessParam(name="result.tu",description="土")
	 * @ApiSuccessParam(name="result.sui",description="水")
	 * @ApiSuccessParam(name="result.huo",description="火")
	 * @ApiSuccessParam(name="result.light",description="光")
	 * @ApiSuccessParam(name="result.dark",description="暗")
	 * @ApiSuccessParam(name="result.luck",description="幸运值")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserEquipmentBackpackModel();
		$info = $model->get(['backpackId' => $param['backpackId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/UserEquipmentBackpack/getList")
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
	 * @ApiSuccessParam(name="result[].backpackId",description="背包id")
	 * @ApiSuccessParam(name="result[].userId",description="用户id")
	 * @ApiSuccessParam(name="result[].isUse",description="是否使用")
	 * @ApiSuccessParam(name="result[].strengthenLevel",description="强化等级")
	 * @ApiSuccessParam(name="result[].attributeDescription",description="属性介绍")
	 * @ApiSuccessParam(name="result[].attributeEntryDescription",description="随机属性介绍")
	 * @ApiSuccessParam(name="result[].extraAttributeDescription",description="额外词条属性介绍")
	 * @ApiSuccessParam(name="result[].suitAttribute2Description",description="套装2属性词条介绍")
	 * @ApiSuccessParam(name="result[].suitAttribute3Description",description="套装3属性词条介绍")
	 * @ApiSuccessParam(name="result[].suitAttribute5Description",description="套装5属性词条介绍")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result[].goodsName",description="物品名")
	 * @ApiSuccessParam(name="result[].equipmentType",description="装备类型")
	 * @ApiSuccessParam(name="result[].suitCode",description="套装code")
	 * @ApiSuccessParam(name="result[].rarityLevel",description="稀有度")
	 * @ApiSuccessParam(name="result[].level",description="装备等级")
	 * @ApiSuccessParam(name="result[].hp",description="血量")
	 * @ApiSuccessParam(name="result[].mp",description="法力值")
	 * @ApiSuccessParam(name="result[].attack",description="攻击力")
	 * @ApiSuccessParam(name="result[].defense",description="防御力")
	 * @ApiSuccessParam(name="result[].endurance",description="耐力")
	 * @ApiSuccessParam(name="result[].intellect",description="智力")
	 * @ApiSuccessParam(name="result[].strength",description="力量")
	 * @ApiSuccessParam(name="result[].criticalRate",description="暴击率")
	 * @ApiSuccessParam(name="result[].criticalStrikeDamage",description="暴击伤害")
	 * @ApiSuccessParam(name="result[].hitRate",description="命中率")
	 * @ApiSuccessParam(name="result[].dodgeRate",description="闪避率")
	 * @ApiSuccessParam(name="result[].penetrate",description="穿透")
	 * @ApiSuccessParam(name="result[].attackSpeed",description="攻击速度")
	 * @ApiSuccessParam(name="result[].userElement",description="角色元素")
	 * @ApiSuccessParam(name="result[].attackElement",description="攻击元素")
	 * @ApiSuccessParam(name="result[].jin",description="金")
	 * @ApiSuccessParam(name="result[].mu",description="木")
	 * @ApiSuccessParam(name="result[].tu",description="土")
	 * @ApiSuccessParam(name="result[].sui",description="水")
	 * @ApiSuccessParam(name="result[].huo",description="火")
	 * @ApiSuccessParam(name="result[].light",description="光")
	 * @ApiSuccessParam(name="result[].dark",description="暗")
	 * @ApiSuccessParam(name="result[].luck",description="幸运值")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserEquipmentBackpackModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/UserEquipmentBackpack/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="backpackId",alias="背包id",description="背包id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserEquipmentBackpackModel();
		$info = $model->get(['backpackId' => $param['backpackId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

