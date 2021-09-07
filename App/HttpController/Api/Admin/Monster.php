<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\MonsterModel;
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
 * Monster
 * Class Monster
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.Monster")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Monster extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Monster/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="monsterId",lengthMax="11",required="")
	 * @Param(name="name",alias="怪物名称",description="怪物名称",lengthMax="255",required="")
	 * @Param(name="type",alias="怪物类型 1小怪,2精英,3boss",description="怪物类型 1小怪,2精英,3boss",lengthMax="11",required="")
	 * @Param(name="description",alias="怪物介绍",description="怪物介绍",lengthMax="255",required="")
	 * @Param(name="level",alias="怪物等级",description="怪物等级",lengthMax="11",required="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="11",required="")
	 * @Param(name="mp",alias="法力",description="法力",lengthMax="11",required="")
	 * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",required="")
	 * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",required="")
	 * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",required="")
	 * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",required="")
	 * @Param(name="strength",alias="力量",description="力量",lengthMax="11",required="")
	 * @Param(name="enduranceQualification",alias="耐力资质",description="耐力资质",lengthMax="11",required="")
	 * @Param(name="intellectQualification",alias="智力资质",description="智力资质",lengthMax="11",required="")
	 * @Param(name="strengthQualification",alias="力量资质",description="力量资质",lengthMax="11",required="")
	 * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",required="")
	 * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",required="")
	 * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",required="")
     * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
     * @Param(name="penetrate",alias="穿透力",description="穿透力",lengthMax="11",required="")
	 * @Param(name="attackSpeed",alias="攻击速度",description="攻击速度",lengthMax="11",required="")
	 * @Param(name="userElement",alias="角色元素",description="角色元素",lengthMax="11",required="")
	 * @Param(name="attackElement",alias="攻击元素",description="攻击元素",lengthMax="11",required="")
	 * @Param(name="jin",alias="金",description="金",lengthMax="11",required="")
	 * @Param(name="mu",alias="木",description="木",lengthMax="11",required="")
	 * @Param(name="tu",alias="土",description="土",lengthMax="11",required="")
	 * @Param(name="sui",alias="水",description="水",lengthMax="11",required="")
	 * @Param(name="huo",alias="火",description="火",lengthMax="11",required="")
	 * @Param(name="light",alias="光",description="光",lengthMax="11",required="")
	 * @Param(name="dark",alias="暗",description="暗",lengthMax="11",required="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'monsterId'=>$param['monsterId'],
		    'name'=>$param['name'],
		    'type'=>$param['type'],
		    'description'=>$param['description'],
		    'level'=>$param['level'],
		    'hp'=>$param['hp'],
		    'mp'=>$param['mp'],
		    'attack'=>$param['attack'],
		    'defense'=>$param['defense'],
		    'endurance'=>$param['endurance'],
		    'intellect'=>$param['intellect'],
		    'strength'=>$param['strength'],
		    'enduranceQualification'=>$param['enduranceQualification'],
		    'intellectQualification'=>$param['intellectQualification'],
		    'strengthQualification'=>$param['strengthQualification'],
		    'criticalRate'=>$param['criticalRate'],
		    'criticalStrikeDamage'=>$param['criticalStrikeDamage'],
		    'hitRate'=>$param['hitRate'],
            'dodgeRate'=>$param['dodgeRate'],
            'penetrate'=>$param['penetrate'],
		    'attackSpeed'=>$param['attackSpeed'],
		    'userElement'=>$param['userElement'],
		    'attackElement'=>$param['attackElement'],
		    'jin'=>$param['jin'],
		    'mu'=>$param['mu'],
		    'tu'=>$param['tu'],
		    'sui'=>$param['sui'],
		    'huo'=>$param['huo'],
		    'light'=>$param['light'],
		    'dark'=>$param['dark'],
		];
		$model = new MonsterModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Monster/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="monsterId",lengthMax="11",required="")
	 * @Param(name="name",alias="怪物名称",description="怪物名称",lengthMax="255",optional="")
	 * @Param(name="type",alias="怪物类型 1小怪,2精英,3boss",description="怪物类型 1小怪,2精英,3boss",lengthMax="11",optional="")
	 * @Param(name="description",alias="怪物介绍",description="怪物介绍",lengthMax="255",optional="")
	 * @Param(name="level",alias="怪物等级",description="怪物等级",lengthMax="11",optional="")
	 * @Param(name="hp",alias="血量",description="血量",lengthMax="11",optional="")
	 * @Param(name="mp",alias="法力",description="法力",lengthMax="11",optional="")
	 * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",optional="")
	 * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",optional="")
	 * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",optional="")
	 * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",optional="")
	 * @Param(name="strength",alias="力量",description="力量",lengthMax="11",optional="")
	 * @Param(name="enduranceQualification",alias="耐力资质",description="耐力资质",lengthMax="11",optional="")
	 * @Param(name="intellectQualification",alias="智力资质",description="智力资质",lengthMax="11",optional="")
	 * @Param(name="strengthQualification",alias="力量资质",description="力量资质",lengthMax="11",optional="")
	 * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",optional="")
	 * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",optional="")
	 * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",optional="")
     * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
     * @Param(name="penetrate",alias="穿透力",description="穿透力",lengthMax="11",optional="")
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
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MonsterModel();
		$info = $model->get(['monsterId' => $param['monsterId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['hp']=$param['hp'] ?? $info->hp;
		$updateData['mp']=$param['mp'] ?? $info->mp;
		$updateData['attack']=$param['attack'] ?? $info->attack;
		$updateData['defense']=$param['defense'] ?? $info->defense;
		$updateData['endurance']=$param['endurance'] ?? $info->endurance;
		$updateData['intellect']=$param['intellect'] ?? $info->intellect;
		$updateData['strength']=$param['strength'] ?? $info->strength;
		$updateData['enduranceQualification']=$param['enduranceQualification'] ?? $info->enduranceQualification;
		$updateData['intellectQualification']=$param['intellectQualification'] ?? $info->intellectQualification;
		$updateData['strengthQualification']=$param['strengthQualification'] ?? $info->strengthQualification;
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
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Monster/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="monsterId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.monsterId",description="")
	 * @ApiSuccessParam(name="result.name",description="怪物名称")
	 * @ApiSuccessParam(name="result.type",description="怪物类型 1小怪,2精英,3boss")
	 * @ApiSuccessParam(name="result.description",description="怪物介绍")
	 * @ApiSuccessParam(name="result.level",description="怪物等级")
	 * @ApiSuccessParam(name="result.hp",description="血量")
	 * @ApiSuccessParam(name="result.mp",description="法力")
	 * @ApiSuccessParam(name="result.attack",description="攻击力")
	 * @ApiSuccessParam(name="result.defense",description="防御力")
	 * @ApiSuccessParam(name="result.endurance",description="耐力")
	 * @ApiSuccessParam(name="result.intellect",description="智力")
	 * @ApiSuccessParam(name="result.strength",description="力量")
	 * @ApiSuccessParam(name="result.enduranceQualification",description="耐力资质")
	 * @ApiSuccessParam(name="result.intellectQualification",description="智力资质")
	 * @ApiSuccessParam(name="result.strengthQualification",description="力量资质")
	 * @ApiSuccessParam(name="result.criticalRate",description="暴击率")
	 * @ApiSuccessParam(name="result.criticalStrikeDamage",description="暴击伤害")
	 * @ApiSuccessParam(name="result.hitRate",description="命中率")
     * @ApiSuccessParam(name="result.dodgeRate",description="闪避率")
     * @ApiSuccessParam(name="result.penetrate",description="穿透力")
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
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MonsterModel();
		$info = $model->get(['monsterId' => $param['monsterId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/Monster/getList")
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
	 * @ApiSuccessParam(name="result[].monsterId",description="")
	 * @ApiSuccessParam(name="result[].name",description="怪物名称")
	 * @ApiSuccessParam(name="result[].type",description="怪物类型 1小怪,2精英,3boss")
	 * @ApiSuccessParam(name="result[].description",description="怪物介绍")
	 * @ApiSuccessParam(name="result[].level",description="怪物等级")
	 * @ApiSuccessParam(name="result[].hp",description="血量")
	 * @ApiSuccessParam(name="result[].mp",description="法力")
	 * @ApiSuccessParam(name="result[].attack",description="攻击力")
	 * @ApiSuccessParam(name="result[].defense",description="防御力")
	 * @ApiSuccessParam(name="result[].endurance",description="耐力")
	 * @ApiSuccessParam(name="result[].intellect",description="智力")
	 * @ApiSuccessParam(name="result[].strength",description="力量")
	 * @ApiSuccessParam(name="result[].enduranceQualification",description="耐力资质")
	 * @ApiSuccessParam(name="result[].intellectQualification",description="智力资质")
	 * @ApiSuccessParam(name="result[].strengthQualification",description="力量资质")
	 * @ApiSuccessParam(name="result[].criticalRate",description="暴击率")
	 * @ApiSuccessParam(name="result[].criticalStrikeDamage",description="暴击伤害")
	 * @ApiSuccessParam(name="result[].hitRate",description="命中率")
     * @ApiSuccessParam(name="result[].dodgeRate",description="闪避率")
     * @ApiSuccessParam(name="result[].penetrate",description="穿透力")
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
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new MonsterModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Monster/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="monsterId",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new MonsterModel();
		$info = $model->get(['monsterId' => $param['monsterId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

