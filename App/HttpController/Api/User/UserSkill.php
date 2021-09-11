<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserSkillModel;
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
 * UserSkill
 * Class UserSkill
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserSkill")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserSkill extends UserBase
{
	/**
	 * @Api(name="update",path="/Api/User/UserSkill/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userSkillId",alias="玩家技能id",description="玩家技能id",lengthMax="11",required="")
	 * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",optional="")
	 * @Param(name="skillName",alias="技能名",description="技能名",lengthMax="255",optional="")
	 * @Param(name="isUse",alias="是否穿戴",description="是否穿戴",lengthMax="1",optional="")
	 * @Param(name="level",alias="技能等级",description="技能等级",lengthMax="255",optional="")
	 * @Param(name="type",alias=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="1",optional="")
	 * @Param(name="rarityLevel",alias="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="255",optional="")
	 * @Param(name="maxLevel",alias="最大等级",description="最大等级",lengthMax="255",optional="")
	 * @Param(name="coolingTime",alias="冷却时间",description="冷却时间",lengthMax="11",optional="")
	 * @Param(name="manaCostQualification",alias="耗蓝资质",description="耗蓝资质",lengthMax="11",optional="")
	 * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="255",optional="")
	 * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserSkillModel();
		$info = $model->get(['userSkillId' => $param['userSkillId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['skillId']=$param['skillId'] ?? $info->skillId;
		$updateData['skillName']=$param['skillName'] ?? $info->skillName;
		$updateData['isUse']=$param['isUse'] ?? $info->isUse;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['type']=$param['type'] ?? $info->type;
		$updateData['rarityLevel']=$param['rarityLevel'] ?? $info->rarityLevel;
		$updateData['maxLevel']=$param['maxLevel'] ?? $info->maxLevel;
		$updateData['coolingTime']=$param['coolingTime'] ?? $info->coolingTime;
		$updateData['manaCostQualification']=$param['manaCostQualification'] ?? $info->manaCostQualification;
		$updateData['entryCode']=$param['entryCode'] ?? $info->entryCode;
		$updateData['description']=$param['description'] ?? $info->description;
		$updateData['param']=$param['param'] ?? $info->param;
		$updateData['qualification']=$param['qualification'] ?? $info->qualification;
		$updateData['manaCost']=$param['manaCost'] ?? $info->manaCost;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserSkill/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userSkillId",alias="玩家技能id",description="玩家技能id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userSkillId",description="玩家技能id")
	 * @ApiSuccessParam(name="result.userId",description="玩家id")
	 * @ApiSuccessParam(name="result.skillId",description="技能id")
	 * @ApiSuccessParam(name="result.skillName",description="技能名")
	 * @ApiSuccessParam(name="result.isUse",description="是否穿戴")
	 * @ApiSuccessParam(name="result.level",description="技能等级")
	 * @ApiSuccessParam(name="result.type",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result.maxLevel",description="最大等级")
	 * @ApiSuccessParam(name="result.coolingTime",description="冷却时间")
	 * @ApiSuccessParam(name="result.manaCostQualification",description="耗蓝资质")
	 * @ApiSuccessParam(name="result.entryCode",description="词条code")
	 * @ApiSuccessParam(name="result.description",description="介绍")
	 * @ApiSuccessParam(name="result.param",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
	 * @ApiSuccessParam(name="result.qualification",description="技能资质,json数组,例如词条为:攻击力增加1,那每升一级攻击力+参数")
	 * @ApiSuccessParam(name="result.manaCost",description="耗蓝")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserSkillModel();
		$info = $model->get(['userSkillId' => $param['userSkillId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/UserSkill/getList")
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
	 * @ApiSuccessParam(name="result[].userSkillId",description="玩家技能id")
	 * @ApiSuccessParam(name="result[].userId",description="玩家id")
	 * @ApiSuccessParam(name="result[].skillId",description="技能id")
	 * @ApiSuccessParam(name="result[].skillName",description="技能名")
	 * @ApiSuccessParam(name="result[].isUse",description="是否穿戴")
	 * @ApiSuccessParam(name="result[].level",description="技能等级")
	 * @ApiSuccessParam(name="result[].type",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发")
	 * @ApiSuccessParam(name="result[].rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
	 * @ApiSuccessParam(name="result[].maxLevel",description="最大等级")
	 * @ApiSuccessParam(name="result[].coolingTime",description="冷却时间")
	 * @ApiSuccessParam(name="result[].manaCostQualification",description="耗蓝资质")
	 * @ApiSuccessParam(name="result[].entryCode",description="词条code")
	 * @ApiSuccessParam(name="result[].description",description="介绍")
	 * @ApiSuccessParam(name="result[].param",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
	 * @ApiSuccessParam(name="result[].qualification",description="技能资质,json数组,例如词条为:攻击力增加1,那每升一级攻击力+参数")
	 * @ApiSuccessParam(name="result[].manaCost",description="耗蓝")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserSkillModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/UserSkill/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userSkillId",alias="玩家技能id",description="玩家技能id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserSkillModel();
		$info = $model->get(['userSkillId' => $param['userSkillId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

