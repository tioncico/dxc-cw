<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserBuyShopGoodsOrderModel;
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
 * UserBuyShopGoodsOrder
 * Class UserBuyShopGoodsOrder
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserBuyShopGoodsOrder")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserBuyShopGoodsOrder extends UserBase
{
	/**
	 * @Api(name="add",path="/Api/User/UserBuyShopGoodsOrder/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="orderId",alias="订单id",description="订单id",lengthMax="11",required="")
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
	 * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",optional="")
	 * @Param(name="num",alias="购买数量",description="购买数量",lengthMax="11",optional="")
	 * @Param(name="date",alias="购买日期",description="购买日期",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'orderId'=>$param['orderId'],
		    'userId'=>$param['userId'] ?? '',
		    'shopGoodsId'=>$param['shopGoodsId'] ?? '',
		    'num'=>$param['num'] ?? '',
		    'date'=>$param['date'] ?? '',
		    'addTime'=>$param['addTime'] ?? '',
		];
		$model = new UserBuyShopGoodsOrderModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/User/UserBuyShopGoodsOrder/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="orderId",alias="订单id",description="订单id",lengthMax="11",required="")
	 * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
	 * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",optional="")
	 * @Param(name="num",alias="购买数量",description="购买数量",lengthMax="11",optional="")
	 * @Param(name="date",alias="购买日期",description="购买日期",lengthMax="11",optional="")
	 * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserBuyShopGoodsOrderModel();
		$info = $model->get(['orderId' => $param['orderId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['shopGoodsId']=$param['shopGoodsId'] ?? $info->shopGoodsId;
		$updateData['num']=$param['num'] ?? $info->num;
		$updateData['date']=$param['date'] ?? $info->date;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/User/UserBuyShopGoodsOrder/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="orderId",alias="订单id",description="订单id",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.orderId",description="订单id")
	 * @ApiSuccessParam(name="result.userId",description="用户id")
	 * @ApiSuccessParam(name="result.shopGoodsId",description="商品id")
	 * @ApiSuccessParam(name="result.num",description="购买数量")
	 * @ApiSuccessParam(name="result.date",description="购买日期")
	 * @ApiSuccessParam(name="result.addTime",description="新增时间")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserBuyShopGoodsOrderModel();
		$info = $model->get(['orderId' => $param['orderId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/User/UserBuyShopGoodsOrder/getList")
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
	 * @ApiSuccessParam(name="result[].orderId",description="订单id")
	 * @ApiSuccessParam(name="result[].userId",description="用户id")
	 * @ApiSuccessParam(name="result[].shopGoodsId",description="商品id")
	 * @ApiSuccessParam(name="result[].num",description="购买数量")
	 * @ApiSuccessParam(name="result[].date",description="购买日期")
	 * @ApiSuccessParam(name="result[].addTime",description="新增时间")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserBuyShopGoodsOrderModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/User/UserBuyShopGoodsOrder/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="orderId",alias="订单id",description="订单id",lengthMax="11",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserBuyShopGoodsOrderModel();
		$info = $model->get(['orderId' => $param['orderId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

