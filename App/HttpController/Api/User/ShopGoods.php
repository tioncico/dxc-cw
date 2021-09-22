<?php

namespace App\HttpController\Api\User;

use App\Model\Game\ShopGoodsModel;
use App\Model\Game\UserBackpackModel;
use App\Service\Game\ShopGoodsService;
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
 * ShopGoods
 * Class ShopGoods
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.ShopGoods")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class ShopGoods extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/ShopGoods/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",required="")
     * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="32",optional="")
     * @Param(name="goodsName",alias="物品名",description="物品名",lengthMax="64",optional="")
     * @Param(name="limit",alias="永久购买限制",description="永久购买限制",lengthMax="255",optional="")
     * @Param(name="limitType",alias="限制类型 0永久,1每日,2每周,3每月",description="限制类型 0永久,1每日,2每周,3每月",lengthMax="255",optional="")
     * @Param(name="price",alias="售价",description="售价",lengthMax="10",optional="")
     * @Param(name="stock",alias="库存,0表示没有库存",description="库存,0表示没有库存",lengthMax="255",optional="")
     * @Param(name="priceType",alias="售价类型 1金币,2钻石 ",description="售价类型 1金币,2钻石 ",lengthMax="1",optional="")
     * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'shopGoodsId' => $param['shopGoodsId'],
            'goodsCode'   => $param['goodsCode'] ?? '',
            'goodsName'   => $param['goodsName'] ?? '',
            'limit'       => $param['limit'] ?? '',
            'limitType'   => $param['limitType'] ?? '',
            'price'       => $param['price'] ?? '',
            'stock'       => $param['stock'] ?? '',
            'priceType'   => $param['priceType'] ?? '',
            'addTime'     => $param['addTime'] ?? '',
        ];
        $model = new ShopGoodsModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


    /**
     * @Api(name="update",path="/Api/User/ShopGoods/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",required="")
     * @Param(name="goodsCode",alias="物品code",description="物品code",lengthMax="32",optional="")
     * @Param(name="goodsName",alias="物品名",description="物品名",lengthMax="64",optional="")
     * @Param(name="limit",alias="永久购买限制",description="永久购买限制",lengthMax="255",optional="")
     * @Param(name="limitType",alias="限制类型 0永久,1每日,2每周,3每月",description="限制类型 0永久,1每日,2每周,3每月",lengthMax="255",optional="")
     * @Param(name="price",alias="售价",description="售价",lengthMax="10",optional="")
     * @Param(name="stock",alias="库存,0表示没有库存",description="库存,0表示没有库存",lengthMax="255",optional="")
     * @Param(name="priceType",alias="售价类型 1金币,2钻石 ",description="售价类型 1金币,2钻石 ",lengthMax="1",optional="")
     * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
     */
    public function update()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new ShopGoodsModel();
        $info = $model->get(['shopGoodsId' => $param['shopGoodsId']]);
        if (empty($info)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
            return false;
        }
        $updateData = [];

        $updateData['goodsCode'] = $param['goodsCode'] ?? $info->goodsCode;
        $updateData['goodsName'] = $param['goodsName'] ?? $info->goodsName;
        $updateData['limit'] = $param['limit'] ?? $info->limit;
        $updateData['limitType'] = $param['limitType'] ?? $info->limitType;
        $updateData['price'] = $param['price'] ?? $info->price;
        $updateData['stock'] = $param['stock'] ?? $info->stock;
        $updateData['priceType'] = $param['priceType'] ?? $info->priceType;
        $updateData['addTime'] = $param['addTime'] ?? $info->addTime;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }


    /**
     * @Api(name="getOne",path="/Api/User/ShopGoods/getOne")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.shopGoodsId",description="商品id")
     * @ApiSuccessParam(name="result.goodsCode",description="物品code")
     * @ApiSuccessParam(name="result.goodsName",description="物品名")
     * @ApiSuccessParam(name="result.limit",description="永久购买限制")
     * @ApiSuccessParam(name="result.limitType",description="限制类型 0永久,1每日,2每周,3每月")
     * @ApiSuccessParam(name="result.price",description="售价")
     * @ApiSuccessParam(name="result.stock",description="库存,0表示没有库存")
     * @ApiSuccessParam(name="result.priceType",description="售价类型 1金币,2钻石 ")
     * @ApiSuccessParam(name="result.addTime",description="新增时间")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new ShopGoodsModel();
        $info = $model->get(['shopGoodsId' => $param['shopGoodsId']]);
        if ($info) {
            $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
        }
    }


    /**
     * @Api(name="购买道具",path="/Api/User/ShopGoods/buy")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",required="")
     * @Param(name="num",alias="购买数量",description="购买数量",min="1",max="100",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.shopGoodsId",description="商品id")
     * @ApiSuccessParam(name="result.goodsCode",description="物品code")
     * @ApiSuccessParam(name="result.goodsName",description="物品名")
     * @ApiSuccessParam(name="result.limit",description="永久购买限制")
     * @ApiSuccessParam(name="result.limitType",description="限制类型 0永久,1每日,2每周,3每月")
     * @ApiSuccessParam(name="result.price",description="售价")
     * @ApiSuccessParam(name="result.stock",description="库存,0表示没有库存")
     * @ApiSuccessParam(name="result.priceType",description="售价类型 1金币,2钻石 ")
     * @ApiSuccessParam(name="result.addTime",description="新增时间")
     */
    public function buy()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new ShopGoodsModel();
        $num = $param['num'];
        $info = $model->field("
		*,
		if(limitType=1,shopGoodsId,null) as shopGoodsIdByToday,
		if(limitType=2,shopGoodsId,null) as shopGoodsIdBy7Day,
		if(limitType=3,shopGoodsId,null) as shopGoodsIdBy30Day
		")->with(['todayBuyInfo','byInfoIn7Day','byInfoIn30Day',],false)->get(['shopGoodsId' => $param['shopGoodsId']]);
        Assert::assert(!!$info,'商品不存在');

        //判断金币或者钻石是否足够
        $price = $info->price * $num;
        if ($info->priceType==1){
            $goldInfo = UserBackpackModel::create()->lockForUpdate()->getUseMoneyInfo($this->who->userId);
            Assert::assert($goldInfo->num>=$price,"金币数量不足");
        }else{
            $moneyInfo = UserBackpackModel::create()->lockForUpdate()->getUseGoldInfo($this->who->userId);
            Assert::assert($moneyInfo->num>=$price,"钻石数量不足");
        }
        //判断是否已经超出购买限制
        if ($info->limitType==1){
            Assert::assert($info->todayBuyInfo->num+$num<=$info->limit,"购买超出限制");
        }
        if ($info->limitType==2){
            Assert::assert($info->byInfoIn7Day->num+$num<=$info->limit,"购买超出限制");
        }
        if ($info->limitType==3){
            Assert::assert($info->byInfoIn30Day->num+$num<=$info->limit,"购买超出限制");
        }


        ShopGoodsService::getInstance()->buyGoods($this->who->userId,$info,$param['num']);
        $this->writeJson(Status::CODE_OK, [], "购买成功.");
    }


    /**
     * @Api(name="getList",path="/Api/User/ShopGoods/getList")
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
     * @ApiSuccessParam(name="result[].shopGoodsId",description="商品id")
     * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].goodsName",description="物品名")
     * @ApiSuccessParam(name="result[].limit",description="永久购买限制")
     * @ApiSuccessParam(name="result[].limitType",description="限制类型 0永久,1每日,2每周,3每月")
     * @ApiSuccessParam(name="result[].price",description="售价")
     * @ApiSuccessParam(name="result[].stock",description="库存,0表示没有库存")
     * @ApiSuccessParam(name="result[].priceType",description="售价类型 1金币,2钻石 ")
     * @ApiSuccessParam(name="result[].addTime",description="新增时间")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 9999);
        $model = new ShopGoodsModel();
        $data = $model->with(['todayBuyInfo','byInfoIn7Day','byInfoIn30Day',],false)->getList($page, $pageSize,"
		*,
		if(limitType=1,shopGoodsId,null) as shopGoodsIdByToday,
		if(limitType=2,shopGoodsId,null) as shopGoodsIdBy7Day,
		if(limitType=3,shopGoodsId,null) as shopGoodsIdBy30Day
		");
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }


    /**
     * @Api(name="delete",path="/Api/User/ShopGoods/delete")
     * @ApiDescription("删除数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="shopGoodsId",alias="商品id",description="商品id",lengthMax="11",required="")
     */
    public function delete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new ShopGoodsModel();
        $info = $model->get(['shopGoodsId' => $param['shopGoodsId']]);
        if (!$info) {
            $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
        }

        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }
}

