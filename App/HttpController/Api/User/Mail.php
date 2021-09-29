<?php

namespace App\HttpController\Api\User;

use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\MailGoodsModel;
use App\Model\Game\MailModel;
use App\Model\Game\UserBackpackModel;
use App\Service\Game\BackpackService;
use App\Service\GameResponse;
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
use function AlibabaCloud\Client\value;

/**
 * Mail
 * Class Mail
 * Create With ClassGeneration
 * @ApiGroup(groupName="邮件功能")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Mail extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/Mail/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="id",lengthMax="11",required="")
     * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",required="")
     * @Param(name="name",alias="邮件标题",description="邮件标题",lengthMax="32",required="")
     * @Param(name="msg",alias="邮件内容",description="邮件内容",lengthMax="255",required="")
     * @Param(name="addTime",alias="发送时间",description="发送时间",lengthMax="11",required="")
     * @Param(name="isRead",alias="是否已读",description="是否已读",lengthMax="1",required="")
     * @Param(name="isReceive",alias="是否已接收",description="是否已接收",lengthMax="1",required="")
     * @Param(name="isDelete",alias="是否删除",description="是否删除",lengthMax="1",required="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'id'        => $param['id'],
            'userId'    => $param['userId'],
            'name'      => $param['name'],
            'msg'       => $param['msg'],
            'addTime'   => $param['addTime'],
            'isRead'    => $param['isRead'],
            'isReceive' => $param['isReceive'],
            'isDelete'  => $param['isDelete'],
        ];
        $model = new MailModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


    /**
     * @Api(name="update",path="/Api/User/Mail/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="id",lengthMax="11",required="")
     * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
     * @Param(name="name",alias="邮件标题",description="邮件标题",lengthMax="32",optional="")
     * @Param(name="msg",alias="邮件内容",description="邮件内容",lengthMax="255",optional="")
     * @Param(name="addTime",alias="发送时间",description="发送时间",lengthMax="11",optional="")
     * @Param(name="isRead",alias="是否已读",description="是否已读",lengthMax="1",optional="")
     * @Param(name="isReceive",alias="是否已接收",description="是否已接收",lengthMax="1",optional="")
     * @Param(name="isDelete",alias="是否删除",description="是否删除",lengthMax="1",optional="")
     */
    public function update()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new MailModel();
        $info = $model->get(['id' => $param['id']]);
        if (empty($info)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
            return false;
        }
        $updateData = [];

        $updateData['userId'] = $param['userId'] ?? $info->userId;
        $updateData['name'] = $param['name'] ?? $info->name;
        $updateData['msg'] = $param['msg'] ?? $info->msg;
        $updateData['addTime'] = $param['addTime'] ?? $info->addTime;
        $updateData['isRead'] = $param['isRead'] ?? $info->isRead;
        $updateData['isReceive'] = $param['isReceive'] ?? $info->isReceive;
        $updateData['isDelete'] = $param['isDelete'] ?? $info->isDelete;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }

    /**
     * @Api(name="领取邮件物品",path="/Api/User/Mail/receive")
     * @ApiDescription("领取")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[{"id":1,"mailId":2,"goodsCode":"pet00031","num":1,"goodsInfo":{"goodsId":158,"name":"宠物蛋·光之子","code":"pet00031","baseCode":null,"type":6,"description":"宠物蛋·光之子","gold":1,"isSale":1,"level":1,"rarityLevel":1,"extraData":"500"}}],"msg":"领取成功","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.[].id",description="")
     * @ApiSuccessParam(name="result.[].mailId",description="邮件id")
     * @ApiSuccessParam(name="result.[].goodsId",description="物品id")
     * @ApiSuccessParam(name="result.[].num",description="数量")
     * @ApiSuccessParam(name="result.[].goodsInfo.goodsId",description="物品id")
     * @ApiSuccessParam(name="result.[].goodsInfo.name",description="物品名称")
     * @ApiSuccessParam(name="result.[].goodsInfo.code",description="物品code值")
     * @ApiSuccessParam(name="result.[].goodsInfo.baseCode",description="物品基础类型")
     * @ApiSuccessParam(name="result.[].goodsInfo.type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
     * @ApiSuccessParam(name="result.[].goodsInfo.description",description="介绍")
     * @ApiSuccessParam(name="result.[].goodsInfo.gold",description="售出金币")
     * @ApiSuccessParam(name="result.[].goodsInfo.isSale",description="是否可售出")
     * @ApiSuccessParam(name="result.[].goodsInfo.level",description="等级")
     * @ApiSuccessParam(name="result.[].goodsInfo.rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result.[].goodsInfo.extraData",description="额外数据")
     */
    public function receive()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new MailModel();
        $info = $model->where('userId', $this->who->userId)->get(['id' => $param['id']]);
        Assert::assert(!!$info, '邮件不存在');
        Assert::assert($info->isReceive == 0, '邮件已领取');
        //获取邮件附带数据
        $goodsList = MailGoodsModel::create()
            ->with(['goodsInfo'])->where('mailId', $info->id)->all();
        Assert::assert(!empty($goodsList), '没有附件领取');

        BaseModel::transaction(function () use ($goodsList, $info) {
            /**
             * @var $goods MailGoodsModel
             */
            foreach ($goodsList as $goods) {
                $goodsInfo = $goods->goodsInfo;
                BackpackService::getInstance()->addGoods($this->who->userId, $goodsInfo, $goods->num);
            }
            $info->update(['isReceive' => 1]);
        });
        $this->writeJson(Status::CODE_OK, [], "领取成功");
    }


    /**
     * @Api(name="getOne",path="/Api/User/Mail/getOne")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.id",description="")
     * @ApiSuccessParam(name="result.userId",description="用户id")
     * @ApiSuccessParam(name="result.name",description="邮件标题")
     * @ApiSuccessParam(name="result.msg",description="邮件内容")
     * @ApiSuccessParam(name="result.addTime",description="发送时间")
     * @ApiSuccessParam(name="result.isRead",description="是否已读")
     * @ApiSuccessParam(name="result.isReceive",description="是否已接收")
     * @ApiSuccessParam(name="result.isDelete",description="是否删除")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new MailModel();
        $info = $model->get(['id' => $param['id']]);
        if ($info) {
            $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
        }
    }


    /**
     * @Api(name="获取邮件列表",path="/Api/User/Mail/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"page":1,"pageSize":20,"list":[{"id":2,"userId":1,"name":"测试","msg":"测试","addTime":1631538619,"isRead":0,"isReceive":0,"isDelete":0,"goodsList":[{"goodsId":158,"name":"宠物蛋·光之子","code":"pet00031","baseCode":null,"type":6,"description":"宠物蛋·光之子","gold":1,"isSale":1,"level":1,"rarityLevel":1,"extraData":"500","id":1,"mailId":2,"goodsCode":"pet00031","num":1}]},{"id":1,"userId":1,"name":"测试","msg":"测试","addTime":1631538577,"isRead":0,"isReceive":1,"isDelete":0}],"total":2,"pageCount":1},"msg":"获取列表成功","requestId":null})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="page", from={GET,POST}, alias="页数", optional="")
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].id",description="")
     * @ApiSuccessParam(name="result[].userId",description="用户id")
     * @ApiSuccessParam(name="result[].name",description="邮件标题")
     * @ApiSuccessParam(name="result[].msg",description="邮件内容")
     * @ApiSuccessParam(name="result[].addTime",description="发送时间")
     * @ApiSuccessParam(name="result[].isRead",description="是否已读")
     * @ApiSuccessParam(name="result[].isReceive",description="是否已接收")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 20);
        $model = new MailModel();
        $data = $model->with(['goodsList'], false)->where('userId', $this->who->userId)->where('isDelete', 0)->getList($page, $pageSize);
        foreach ($data['list'] as $key => $mail) {
            $goodsList = $mail['goodsList'];
            foreach ($goodsList as $k=>$value){
                $goodsInfo = [
                    'mailId'    => $value['mailId'],
                    'num'       => $value['num'],
                    'goodsInfo' => [
                        'goodsId'=>$value['goodsId'],
                        'name'=>$value['name'],
                        'code'=>$value['code'],
                        'baseCode'=>$value['baseCode'],
                        'type'=>$value['type'],
                        'description'=>$value['description'],
                        'gold'=>$value['gold'],
                        'isSale'=>$value['isSale'],
                        'level'=>$value['level'],
                        'rarityLevel'=>$value['rarityLevel'],
                        'extraData'=>$value['extraData'],
                    ],
                ];
                $goodsList[$k] = $goodsInfo;
            }
            $data['list'][$key]['goodsList'] = $goodsList;
        }
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }


    /**
     * @Api(name="删除邮件",path="/Api/User/Mail/delete")
     * @ApiDescription("删除数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="id",lengthMax="11",description="删除id,不传则删除所有已领取邮件",optional="")
     */
    public function delete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new MailModel();
        if (isset($param['id'])){
            $model->where('id', $param['id']);
        }
        $model->where('userId', $this->who->userId)->where('isReceive', 1)->update(['isDelete' => 1]);
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }

    /**
     * @Api(name="邮件已读",path="/Api/User/Mail/read")
     * @ApiDescription("邮件已读")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="id",lengthMax="11",description="邮件id",optional="")
     */
    public function read()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new MailModel();
        if (isset($param['id'])){
            $model->where('id', $param['id']);
        }
        $model->where('userId', $this->who->userId)->update(['isRead' => 1]);
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }
}

