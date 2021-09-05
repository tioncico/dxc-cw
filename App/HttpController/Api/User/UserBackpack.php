<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserBackpackModel;
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
 * UserBackpack
 * Class UserBackpack
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserBackpack")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserBackpack extends UserBase
{
	/**
	 * @Api(name="update",path="/Api/User/UserBackpack/update")
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
	 * @Param(name="goodsId",alias="物品id",description="物品id",lengthMax="11",optional="")
	 * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="255",optional="")
	 * @Param(name="num",alias="数量",description="数量",lengthMax="11",optional="")
	 * @Param(name="goodsType",alias="物品类型",description="物品类型",lengthMax="1",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserBackpackModel();
		$info = $model->get(['backpackId' => $param['backpackId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['goodsId']=$param['goodsId'] ?? $info->goodsId;
		$updateData['goodsCode']=$param['goodsCode'] ?? $info->goodsCode;
		$updateData['num']=$param['num'] ?? $info->num;
		$updateData['goodsType']=$param['goodsType'] ?? $info->goodsType;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserBackpack/getOne")
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
	 * @ApiSuccessParam(name="result.goodsId",description="物品id")
	 * @ApiSuccessParam(name="result.goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result.num",description="数量")
	 * @ApiSuccessParam(name="result.goodsType",description="物品类型")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserBackpackModel();
		$info = $model->get(['backpackId' => $param['backpackId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/UserBackpack/getList")
	 * @ApiDescription("获取数据列表")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="goodsType", from={GET,POST}, alias="物品类型",description="1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备", optional="")
	 * @Param(name="code", from={GET,POST}, alias="物品code", optional="")
	 * @Param(name="page", from={GET,POST}, alias="页数", optional="")
	 * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
	 * @ApiSuccessParam(name="result[].backpackId",description="背包id")
	 * @ApiSuccessParam(name="result[].userId",description="用户id")
	 * @ApiSuccessParam(name="result[].goodsId",description="物品id")
	 * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
	 * @ApiSuccessParam(name="result[].num",description="数量")
	 * @ApiSuccessParam(name="result[].goodsType",description="物品类型")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserBackpackModel();
		if ($param['goodsType']){
		    $model->where('goodsType',$param['goodsType']);
        }
		if ($param['code']){
		    $model->where('code',$param['goodsType']);
        }
		$data = $model->with(['goodsInfo'],false)->where('userId',$this->who->userId)->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


    /**
     * @Api(name="getList",path="/Api/User/UserBackpack/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="goodsType", from={GET,POST}, alias="物品类型",description="1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备", optional="")
     * @Param(name="code", from={GET,POST}, alias="物品code", optional="")
     * @Param(name="page", from={GET,POST}, alias="页数", optional="")
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].backpackId",description="背包id")
     * @ApiSuccessParam(name="result[].userId",description="用户id")
     * @ApiSuccessParam(name="result[].goodsId",description="物品id")
     * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].num",description="数量")
     * @ApiSuccessParam(name="result[].goodsType",description="物品类型")
     */
	public function getGold(){
        $model = new UserBackpackModel();
        $goldInfo = $model->getUseGoldInfo($this->who->userId);
        $this->writeJson(Status::CODE_OK, $goldInfo, '获取数据成功');
    }

}

