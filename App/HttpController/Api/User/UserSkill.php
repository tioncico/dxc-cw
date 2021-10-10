<?php

namespace App\HttpController\Api\User;

use App\Model\Game\SkillModel;
use App\Model\Game\UserSkillModel;
use App\Service\Game\SkillService;
use App\Utility\Assert\Assert;
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
 * @ApiGroup(groupName="用户技能")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserSkill extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/UserSkill/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="userId",alias="玩家id",description="玩家id",lengthMax="11",optional="")
     * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",optional="")
     * @Param(name="skillName",alias="技能名",description="技能名",lengthMax="255",optional="")
     * @Param(name="triggerType",alias=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="1",optional="")
     * @Param(name="triggerRate",alias="触发概率计算",description="触发概率计算",lengthMax="255",optional="")
     * @Param(name="isUse",alias="是否穿戴",description="是否穿戴",lengthMax="1",optional="")
     * @Param(name="level",alias="技能等级",description="技能等级",lengthMax="255",optional="")
     * @Param(name="rarityLevel",alias="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="255",optional="")
     * @Param(name="maxLevel",alias="最大等级",description="最大等级",lengthMax="255",optional="")
     * @Param(name="coolingTime",alias="冷却时间",description="冷却时间",lengthMax="255",optional="")
     * @Param(name="manaCost",alias="耗蓝",description="耗蓝",lengthMax="255",optional="")
     * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="255",optional="")
     * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
     * @Param(name="effectParam",alias="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字",lengthMax="255",optional="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'userId'      => $param['userId'] ?? '',
            'skillId'     => $param['skillId'] ?? '',
            'skillName'   => $param['skillName'] ?? '',
            'triggerType' => $param['triggerType'] ?? '',
            'triggerRate' => $param['triggerRate'] ?? '',
            'isUse'       => $param['isUse'] ?? '',
            'level'       => $param['level'] ?? '',
            'rarityLevel' => $param['rarityLevel'] ?? '',
            'maxLevel'    => $param['maxLevel'] ?? '',
            'coolingTime' => $param['coolingTime'] ?? '',
            'manaCost'    => $param['manaCost'] ?? '',
            'entryCode'   => $param['entryCode'] ?? '',
            'description' => $param['description'] ?? '',
            'effectParam' => $param['effectParam'] ?? '',
        ];
        $model = new UserSkillModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


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
     * @Param(name="triggerType",alias=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",description=" 触发类型 0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发",lengthMax="1",optional="")
     * @Param(name="triggerRate",alias="触发概率计算",description="触发概率计算",lengthMax="255",optional="")
     * @Param(name="isUse",alias="是否穿戴",description="是否穿戴",lengthMax="1",optional="")
     * @Param(name="level",alias="技能等级",description="技能等级",lengthMax="255",optional="")
     * @Param(name="rarityLevel",alias="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话",lengthMax="255",optional="")
     * @Param(name="maxLevel",alias="最大等级",description="最大等级",lengthMax="255",optional="")
     * @Param(name="coolingTime",alias="冷却时间",description="冷却时间",lengthMax="255",optional="")
     * @Param(name="manaCost",alias="耗蓝",description="耗蓝",lengthMax="255",optional="")
     * @Param(name="entryCode",alias="词条code",description="词条code",lengthMax="255",optional="")
     * @Param(name="description",alias="介绍",description="介绍",lengthMax="255",optional="")
     * @Param(name="effectParam",alias="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字",lengthMax="255",optional="")
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

        $updateData['userId'] = $param['userId'] ?? $info->userId;
        $updateData['skillId'] = $param['skillId'] ?? $info->skillId;
        $updateData['skillName'] = $param['skillName'] ?? $info->skillName;
        $updateData['triggerType'] = $param['triggerType'] ?? $info->triggerType;
        $updateData['triggerRate'] = $param['triggerRate'] ?? $info->triggerRate;
        $updateData['isUse'] = $param['isUse'] ?? $info->isUse;
        $updateData['level'] = $param['level'] ?? $info->level;
        $updateData['rarityLevel'] = $param['rarityLevel'] ?? $info->rarityLevel;
        $updateData['maxLevel'] = $param['maxLevel'] ?? $info->maxLevel;
        $updateData['coolingTime'] = $param['coolingTime'] ?? $info->coolingTime;
        $updateData['manaCost'] = $param['manaCost'] ?? $info->manaCost;
        $updateData['entryCode'] = $param['entryCode'] ?? $info->entryCode;
        $updateData['description'] = $param['description'] ?? $info->description;
        $updateData['effectParam'] = $param['effectParam'] ?? $info->effectParam;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }


    /**
     * @Api(name="技能出战",path="/Api/User/UserSkill/useSkill")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userSkillId",description="玩家技能id")
     * @ApiSuccessParam(name="result.userId",description="玩家id")
     * @ApiSuccessParam(name="result.skillId",description="技能id")
     * @ApiSuccessParam(name="result.skillName",description="技能名")
     * @ApiSuccessParam(name="result.triggerType",description=" 触发类型 0主动技能,其他都为被动技能")
     * @ApiSuccessParam(name="result.triggerRate",description="触发概率计算")
     * @ApiSuccessParam(name="result.isUse",description="是否穿戴")
     * @ApiSuccessParam(name="result.level",description="技能等级")
     * @ApiSuccessParam(name="result.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result.maxLevel",description="最大等级")
     * @ApiSuccessParam(name="result.coolingTime",description="冷却时间")
     * @ApiSuccessParam(name="result.manaCost",description="耗蓝")
     * @ApiSuccessParam(name="result.entryCode",description="词条code")
     * @ApiSuccessParam(name="result.description",description="介绍")
     * @ApiSuccessParam(name="result.effectParam",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
     */
    public function useSkill()
    {
        $param = ContextManager::getInstance()->get('param');
        $skillInfo = SkillModel::create()->get($param['skillId']);
        Assert::assert(!!$skillInfo, "技能数据不存在!");
        $model = new UserSkillModel();
        $info = $model->getUserSkillByCode($this->who->userId,$skillInfo);
        Assert::assert(!!$info,"你没有学习此技能");
        Assert::assert($info->isUse==0,"技能已出战");
        $info->isUse=1;
        $info->update();
        $this->writeJson(Status::CODE_OK, $info, "技能出战成功.");
    }


    /**
     * @Api(name="技能下场",path="/Api/User/UserSkill/noUseSkill")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userSkillId",description="玩家技能id")
     * @ApiSuccessParam(name="result.userId",description="玩家id")
     * @ApiSuccessParam(name="result.skillId",description="技能id")
     * @ApiSuccessParam(name="result.skillName",description="技能名")
     * @ApiSuccessParam(name="result.triggerType",description=" 触发类型 0主动技能,其他都为被动技能")
     * @ApiSuccessParam(name="result.triggerRate",description="触发概率计算")
     * @ApiSuccessParam(name="result.isUse",description="是否穿戴")
     * @ApiSuccessParam(name="result.level",description="技能等级")
     * @ApiSuccessParam(name="result.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result.maxLevel",description="最大等级")
     * @ApiSuccessParam(name="result.coolingTime",description="冷却时间")
     * @ApiSuccessParam(name="result.manaCost",description="耗蓝")
     * @ApiSuccessParam(name="result.entryCode",description="词条code")
     * @ApiSuccessParam(name="result.description",description="介绍")
     * @ApiSuccessParam(name="result.effectParam",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
     */
    public function noUseSkill()
    {
        $param = ContextManager::getInstance()->get('param');
        $skillInfo = SkillModel::create()->get($param['skillId']);
        Assert::assert(!!$skillInfo, "技能数据不存在!");
        $model = new UserSkillModel();
        $info = $model->getUserSkillByCode($this->who->userId,$skillInfo);
        Assert::assert(!!$info,"你没有学习此技能");
        Assert::assert($info->isUse==1,"技能已下场");
        $info->isUse=0;
        $info->update();
        $this->writeJson(Status::CODE_OK, $info, "技能下场成功.");
    }

    /**
     * @Api(name="获取学习/升级技能所需物品",path="/Api/User/UserSkill/getSkillLevelUpNeedGoodsInfo")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
     * @Param(name="level",alias="需要升级的等级",description="需要升级的等级",lengthMax="11",required="")
     * @ApiSuccessParam(name="result[].id",description="id")
     * @ApiSuccessParam(name="result[].skillId",description="技能id")
     * @ApiSuccessParam(name="result[].level",description="学习等级")
     * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].goodsNum",description="物品数量")
     * @ApiSuccessParam(name="result[].goodsInfo.goodsId",description="物品id")
     * @ApiSuccessParam(name="result[].goodsInfo.name",description="物品名称")
     * @ApiSuccessParam(name="result[].goodsInfo.code",description="物品code值")
     * @ApiSuccessParam(name="result[].goodsInfo.baseCode",description="物品基础类型")
     * @ApiSuccessParam(name="result[].goodsInfo.type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
     * @ApiSuccessParam(name="result[].goodsInfo.description",description="介绍")
     * @ApiSuccessParam(name="result[].goodsInfo.gold",description="售出金币")
     * @ApiSuccessParam(name="result[].goodsInfo.isSale",description="是否可售出")
     * @ApiSuccessParam(name="result[].goodsInfo.level",description="等级")
     * @ApiSuccessParam(name="result[].goodsInfo.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result[].goodsInfo.extraData",description="额外数据")
     */
    public function getSkillLevelUpNeedGoodsInfo()
    {
        $param = ContextManager::getInstance()->get('param');
        $list = SkillService::getInstance()->getStudyNeedGoods($param['skillId'], $param['level']);
        $this->writeJson(Status::CODE_OK, ['list' => $list], "获取数据成功.");
    }


    /**
     * @Api(name="学习/升级技能",path="/Api/User/UserSkill/升级技能所需物品")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userSkillInfo.userSkillId",description="玩家技能id")
     * @ApiSuccessParam(name="result.userSkillInfo.userId",description="玩家id")
     * @ApiSuccessParam(name="result.userSkillInfo.skillId",description="技能id")
     * @ApiSuccessParam(name="result.userSkillInfo.skillName",description="技能名")
     * @ApiSuccessParam(name="result.triggerType",description=" 触发类型 0主动技能,其他都为被动技能")
     * @ApiSuccessParam(name="result.userSkillInfo.triggerRate",description="触发概率计算")
     * @ApiSuccessParam(name="result.userSkillInfo.isUse",description="是否穿戴")
     * @ApiSuccessParam(name="result.userSkillInfo.level",description="技能等级")
     * @ApiSuccessParam(name="result.userSkillInfo.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result.userSkillInfo.maxLevel",description="最大等级")
     * @ApiSuccessParam(name="result.userSkillInfo.coolingTime",description="冷却时间")
     * @ApiSuccessParam(name="result.userSkillInfo.manaCost",description="耗蓝")
     * @ApiSuccessParam(name="result.userSkillInfo.entryCode",description="词条code")
     * @ApiSuccessParam(name="result.userSkillInfo.description",description="介绍")
     * @ApiSuccessParam(name="result.userSkillInfo.effectParam",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
     */
    public function skillLevelUp()
    {
        $param = ContextManager::getInstance()->get('param');
        $skillInfo = SkillModel::create()->get($param['skillId']);
        Assert::assert(!!$skillInfo, "技能数据不存在!");

        $userSkillInfo = SkillService::getInstance()->skillLevelup($this->who->userId,$skillInfo);
        $this->writeJson(Status::CODE_OK, ['userSkillInfo' => $userSkillInfo], "升级技能成功.");
    }


    /**
     * @Api(name="获取用户技能列表",path="/Api/User/UserSkill/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess()
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="page", from={GET,POST}, alias="页数", optional="")
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].userSkillId",description="玩家技能id")
     * @ApiSuccessParam(name="result[].userId",description="玩家id")
     * @ApiSuccessParam(name="result[].skillId",description="技能id")
     * @ApiSuccessParam(name="result[].skillName",description="技能名")
     * @ApiSuccessParam(name="result.triggerType",description=" 触发类型 0主动技能,其他都为被动技能")
     * @ApiSuccessParam(name="result[].triggerRate",description="触发概率计算")
     * @ApiSuccessParam(name="result[].isUse",description="是否穿戴")
     * @ApiSuccessParam(name="result[].level",description="技能等级")
     * @ApiSuccessParam(name="result[].rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result[].maxLevel",description="最大等级")
     * @ApiSuccessParam(name="result[].coolingTime",description="冷却时间")
     * @ApiSuccessParam(name="result[].manaCost",description="耗蓝")
     * @ApiSuccessParam(name="result[].entryCode",description="词条code")
     * @ApiSuccessParam(name="result[].description",description="介绍")
     * @ApiSuccessParam(name="result[].effectParam",description="参数 json数组,例如词条为:攻击力增加x,那param就只有一个参数,参数为数字")
     * @ApiSuccessParam(name="result[].userSkillInfo.skillId",description="技能id")
     * @ApiSuccessParam(name="result[].userSkillInfo.userId",description="用户id")
     * @ApiSuccessParam(name="result[].userSkillInfo.level",description="技能等级")
     * @ApiSuccessParam(name="result[].userSkillInfo.isUse",description="是否出战")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 20);
        $model = new SkillModel();
        $model->field("skill_list.*");
        $model->join('skill_shop_list', 'skill_shop_list.skillId = skill_list.skillId');
//        $model->join('user_skill_list','user_skill_list.skillId = skill_list.skillId and user_skill_list.userId='.$this->who->userId,'right');
        $data = $model->with(['userSkillInfo' => $this->who->userId], false)->all();
        $this->writeJson(Status::CODE_OK, ['list' => $data], '获取列表成功');
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
            return false;
        }

        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }
}

