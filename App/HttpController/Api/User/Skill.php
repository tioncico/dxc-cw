<?php

namespace App\HttpController\Api\User;

use App\Model\Game\SkillModel;
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
 * Skill
 * Class Skill
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.Skill")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Skill extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/Skill/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
	 * @Param(name="name",alias="技能名",description="技能名",lengthMax="255",optional="")
	 * @Param(name="level",alias="技能初始等级",description="技能初始等级",lengthMax="11",optional="")
	 * @Param(name="type",alias=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="1",optional="")
	 * @Param(name="rarityLevel",alias="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="11",optional="")
	 * @Param(name="maxLevel",alias="最大等级",description="最大等级",lengthMax="255",optional="")
	 * @Param(name="coolingTime",alias="冷却时间",description="冷却时间",lengthMax="11",optional="")
	 * @Param(name="manaCost",alias="耗蓝",description="耗蓝",lengthMax="255",optional="")
	 * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="32",optional="")
	 * @Param(name="description",alias="技能介绍",description="技能介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="qualification",alias="资质参数",description="资质参数",lengthMax="255",optional="")
	 * @Param(name="manaCostQualification",alias="耗蓝资质",description="耗蓝资质",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'skillId'=>$param['skillId'],
		    'name'=>$param['name'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'type'=>$param['type'] ?? '',
		    'rarityLevel'=>$param['rarityLevel'] ?? '',
		    'maxLevel'=>$param['maxLevel'] ?? '',
		    'coolingTime'=>$param['coolingTime'] ?? '',
		    'manaCost'=>$param['manaCost'] ?? '',
		    'entryCode'=>$param['entryCode'] ?? '',
		    'description'=>$param['description'] ?? '',
		    'param'=>$param['param'] ?? '',
		    'qualification'=>$param['qualification'] ?? '',
		    'manaCostQualification'=>$param['manaCostQualification'] ?? '',
		];
		$model = new SkillModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/Skill/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
	 * @Param(name="name",alias="技能名",description="技能名",lengthMax="255",optional="")
	 * @Param(name="level",alias="技能初始等级",description="技能初始等级",lengthMax="11",optional="")
	 * @Param(name="type",alias=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="1",optional="")
	 * @Param(name="rarityLevel",alias="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="11",optional="")
	 * @Param(name="maxLevel",alias="最大等级",description="最大等级",lengthMax="255",optional="")
	 * @Param(name="coolingTime",alias="冷却时间",description="冷却时间",lengthMax="11",optional="")
	 * @Param(name="manaCost",alias="耗蓝",description="耗蓝",lengthMax="255",optional="")
	 * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="32",optional="")
	 * @Param(name="description",alias="技能介绍",description="技能介绍",lengthMax="255",optional="")
	 * @Param(name="param",alias="参数",description="参数",lengthMax="255",optional="")
	 * @Param(name="qualification",alias="资质参数",description="资质参数",lengthMax="255",optional="")
	 * @Param(name="manaCostQualification",alias="耗蓝资质",description="耗蓝资质",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillModel();
		$info = $model->get(['skillId' => $param['skillId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['rarityLevel']=$param['rarityLevel'] ?? $info->rarityLevel;
		$updateData['maxLevel']=$param['maxLevel'] ?? $info->maxLevel;
		$updateData['coolingTime']=$param['coolingTime'] ?? $info->coolingTime;
		$updateData['manaCost']=$param['manaCost'] ?? $info->manaCost;
		$updateData['entryCode']=$param['entryCode'] ?? $info->entryCode;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['param']=$param['param'] ?? $info->param;
		$updateData['qualification']=$param['qualification'] ?? $info->qualification;
		$updateData['manaCostQualification']=$param['manaCostQualification'] ?? $info->manaCostQualification;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/Skill/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.skillId",description="技能id")
	 * @ApiSuccessParam(name="result.name",description="技能名")
	 * @ApiSuccessParam(name="result.level",description="技能初始等级")
	 * @ApiSuccessParam(name="result.type",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result.rarityLevel",description="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result.maxLevel",description="最大等级")
	 * @ApiSuccessParam(name="result.coolingTime",description="冷却时间")
	 * @ApiSuccessParam(name="result.manaCost",description="耗蓝")
	 * @ApiSuccessParam(name="result.entryCode",description="词条code")
	 * @ApiSuccessParam(name="result.description",description="技能介绍")
	 * @ApiSuccessParam(name="result.param",description="参数")
	 * @ApiSuccessParam(name="result.qualification",description="资质参数")
	 * @ApiSuccessParam(name="result.manaCostQualification",description="耗蓝资质")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillModel();
		$info = $model->get(['skillId' => $param['skillId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/Skill/getList")
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
	 * @ApiSuccessParam(name="result[].skillId",description="技能id")
	 * @ApiSuccessParam(name="result[].name",description="技能名")
	 * @ApiSuccessParam(name="result[].level",description="技能初始等级")
	 * @ApiSuccessParam(name="result[].type",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result[].rarityLevel",description="技能稀有度1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result[].maxLevel",description="最大等级")
	 * @ApiSuccessParam(name="result[].coolingTime",description="冷却时间")
	 * @ApiSuccessParam(name="result[].manaCost",description="耗蓝")
	 * @ApiSuccessParam(name="result[].entryCode",description="词条code")
	 * @ApiSuccessParam(name="result[].description",description="技能介绍")
	 * @ApiSuccessParam(name="result[].param",description="参数")
	 * @ApiSuccessParam(name="result[].qualification",description="资质参数")
	 * @ApiSuccessParam(name="result[].manaCostQualification",description="耗蓝资质")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new SkillModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/Skill/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillModel();
		$info = $model->get(['skillId' => $param['skillId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

