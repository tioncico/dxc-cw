<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserExtraLimitModel;
use App\Service\Game\UseGoodsService;
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
 * UserBackpack
 * Class UserBackpack
 * Create With ClassGeneration
 * @ApiGroup(groupName="玩家背包")
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

        $updateData['userId'] = $param['userId'] ?? $info->userId;
        $updateData['goodsId'] = $param['goodsId'] ?? $info->goodsId;
        $updateData['goodsCode'] = $param['goodsCode'] ?? $info->goodsCode;
        $updateData['num'] = $param['num'] ?? $info->num;
        $updateData['goodsType'] = $param['goodsType'] ?? $info->goodsType;
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
     * @Api(name="使用物品",path="/Api/User/UserBackpack/useGoods")
     * @ApiDescription("使用物品")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="backpackId",alias="背包id",description="背包id",lengthMax="11",required="")
     * @Param(name="num",alias="使用数量",description="使用数量",min="1",max="100",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.backpackId",description="背包id")
     * @ApiSuccessParam(name="result.userId",description="用户id")
     * @ApiSuccessParam(name="result.goodsId",description="物品id")
     * @ApiSuccessParam(name="result.goodsCode",description="物品code")
     * @ApiSuccessParam(name="result.num",description="数量")
     * @ApiSuccessParam(name="result.goodsType",description="物品类型")
     */
    public function useGoods()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserBackpackModel();
        $info = $model->where('userId',$this->who->userId)->get(['backpackId' => $param['backpackId']]);
        Assert::assert(!!$info, '数据不存在');
//        1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备
        Assert::assert(in_array($info->goodsType,[3,4,6]),'该类型物品不能使用');

        UseGoodsService::getInstance()->useGoods($info,$param['num']);
        $this->writeJson(Status::CODE_OK, null, "使用物品成功.");
    }


    /**
     * @Api(name="获取背包数据",path="/Api/User/UserBackpack/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"page":1,"pageSize":20,"list":[{"backpackId":22,"userId":1,"goodsId":2,"goodsCode":"money","num":20,"goodsType":2,"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null}},{"backpackId":15,"userId":1,"goodsId":7,"goodsCode":"eq_0004","num":1,"goodsType":7,"goodsInfo":{"goodsId":7,"name":"新手之鞋","code":"eq_0004","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":14,"userId":1,"goodsId":7,"goodsCode":"eq_0004","num":1,"goodsType":7,"goodsInfo":{"goodsId":7,"name":"新手之鞋","code":"eq_0004","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":13,"userId":1,"goodsId":9,"goodsCode":"eq_0005","num":1,"goodsType":7,"goodsInfo":{"goodsId":9,"name":"新手之披","code":"eq_0005","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":12,"userId":1,"goodsId":1,"goodsCode":"gold","num":1058,"goodsType":1,"goodsInfo":{"goodsId":1,"name":"金币","code":"gold","baseCode":null,"type":1,"description":"金币,游戏中主要货币之一","gold":0,"isSale":0,"level":1,"rarityLevel":3,"extraData":""}}],"total":5,"pageCount":1},"msg":"获取列表成功","requestId":null})
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
     * @ApiSuccessParam(name="result[].userEquipmentInfo.backpackId",description="背包id")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.isUse",description="是否装备")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.strengthenLevel",description="强化等级")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.attributeDescription",description="属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.attributeEntryDescription",description="随机属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.extraAttributeDescription",description="额外词条属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute2Description",description="套装2属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute3Description",description="套装3属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute5Description",description="套装5属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.goodsName",description="物品名")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.equipmentType",description="装备类型")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitCode",description="套装code")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.rarityLevel",description="稀有度")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.level",description="装备等级")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 9999);
        $model = new UserBackpackModel();
        if (isset($param['goodsType'])) {
            $model->where('goodsType', $param['goodsType']);
        }
        if (isset($param['code'])) {
            $model->where('code', $param['goodsType']);
        }
        $data = $model->with(['goodsInfo', 'userEquipmentInfo', 'strengthenInfo'], false)->where('userId', $this->who->userId)->getList($page, $pageSize);
        $data['maxNum'] = UserExtraLimitModel::create()->getBackPackNum($this->who->userId);
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }

    /**
     * @Api(name="新增背包格子上限",path="/Api/User/UserBackpack/addBackpackMaxNum")
     * @ApiDescription("新增背包格子上限")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"page":1,"pageSize":20,"list":[{"backpackId":22,"userId":1,"goodsId":2,"goodsCode":"money","num":20,"goodsType":2,"goodsInfo":{"goodsId":2,"name":"钻石","code":"money","baseCode":null,"type":2,"description":"钻石,高级游戏货币","gold":0,"isSale":0,"level":1,"rarityLevel":5,"extraData":null}},{"backpackId":15,"userId":1,"goodsId":7,"goodsCode":"eq_0004","num":1,"goodsType":7,"goodsInfo":{"goodsId":7,"name":"新手之鞋","code":"eq_0004","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":14,"userId":1,"goodsId":7,"goodsCode":"eq_0004","num":1,"goodsType":7,"goodsInfo":{"goodsId":7,"name":"新手之鞋","code":"eq_0004","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":13,"userId":1,"goodsId":9,"goodsCode":"eq_0005","num":1,"goodsType":7,"goodsInfo":{"goodsId":9,"name":"新手之披","code":"eq_0005","baseCode":null,"type":7,"description":"新手装备","gold":0,"isSale":1,"level":1,"rarityLevel":1,"extraData":null}},{"backpackId":12,"userId":1,"goodsId":1,"goodsCode":"gold","num":1058,"goodsType":1,"goodsInfo":{"goodsId":1,"name":"金币","code":"gold","baseCode":null,"type":1,"description":"金币,游戏中主要货币之一","gold":0,"isSale":0,"level":1,"rarityLevel":3,"extraData":""}}],"total":5,"pageCount":1},"msg":"获取列表成功","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @ApiSuccessParam(name="result[].backpackId",description="背包id")
     * @ApiSuccessParam(name="result[].userId",description="用户id")
     * @ApiSuccessParam(name="result[].goodsId",description="物品id")
     * @ApiSuccessParam(name="result[].goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].num",description="数量")
     * @ApiSuccessParam(name="result[].goodsType",description="物品类型")
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
     * @ApiSuccessParam(name="result[].userEquipmentInfo.backpackId",description="背包id")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.isUse",description="是否装备")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.strengthenLevel",description="强化等级")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.attributeDescription",description="属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.attributeEntryDescription",description="随机属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.extraAttributeDescription",description="额外词条属性介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute2Description",description="套装2属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute3Description",description="套装3属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitAttribute5Description",description="套装5属性词条介绍")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.goodsCode",description="物品code")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.goodsName",description="物品名")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.equipmentType",description="装备类型")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.suitCode",description="套装code")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.rarityLevel",description="稀有度")
     * @ApiSuccessParam(name="result[].userEquipmentInfo.level",description="装备等级")
     */
    public function addBackpackMaxNum()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 9999);
        $model = new UserBackpackModel();
        if (isset($param['goodsType'])) {
            $model->where('goodsType', $param['goodsType']);
        }
        if (isset($param['code'])) {
            $model->where('code', $param['goodsType']);
        }
        $data = $model->with(['goodsInfo', 'userEquipmentInfo', 'strengthenInfo'], false)->where('userId', $this->who->userId)->getList($page, $pageSize);
        $data['maxNum'] = UserExtraLimitModel::create()->getBackPackNum($this->who->userId);
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }

}

