<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\SkillLevelUpNeedGoodsModel;
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
 * SkillLevelUpNeedGoods
 * Class SkillLevelUpNeedGoods
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.SkillLevelUpNeedGoods")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class SkillLevelUpNeedGoods extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/SkillLevelUpNeedGoods/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",optional="")
	 * @Param(name="level",alias="学习等级",description="学习等级",lengthMax="255",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsNum",alias="物品数量",description="物品数量",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'skillId'=>$param['skillId'] ?? '',
		    'level'=>$param['level'] ?? '',
		    'goodsCode'=>$param['goodsCode'] ?? '',
		    'goodsNum'=>$param['goodsNum'] ?? '',
		];
		$model = new SkillLevelUpNeedGoodsModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/SkillLevelUpNeedGoods/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="id",alias="id",description="id",lengthMax="11",required="")
	 * @Param(name="skillId",alias="技能id",description="技能id",lengthMax="11",optional="")
	 * @Param(name="level",alias="学习等级",description="学习等级",lengthMax="255",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="goodsNum",alias="物品数量",description="物品数量",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillLevelUpNeedGoodsModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['skillId']=$param['skillId'] ?? $info->skillId;
		$updateData['level']=$param['level'] ?? $info->level;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['goodsNum']=$param['goodsNum'] ?? $info->goodsNum;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/SkillLevelUpNeedGoods/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="id",alias="id",description="id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.id",description="id")
	 * @ApiSuccessParam(name="result.skillId",description="技能id")
	 * @ApiSuccessParam(name="result.level",description="学习等级")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result.goodsNum",description="物品数量")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillLevelUpNeedGoodsModel();
		$info = $model->get(['id' => $param['id']]);
		$this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/SkillLevelUpNeedGoods/getList")
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
	 * @ApiSuccessParam(name="result[].id",description="id")
	 * @ApiSuccessParam(name="result[].skillId",description="技能id")
	 * @ApiSuccessParam(name="result[].level",description="学习等级")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result[].goodsNum",description="物品数量")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new SkillLevelUpNeedGoodsModel();

		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/SkillLevelUpNeedGoods/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="id",alias="id",description="id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new SkillLevelUpNeedGoodsModel();
		$info = $model->get(['id' => $param['id']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		    return false;
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

