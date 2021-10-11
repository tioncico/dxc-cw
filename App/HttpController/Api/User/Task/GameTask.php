<?php

namespace App\HttpController\Api\User\Task;

use App\HttpController\Api\User\UserBase;
use App\Model\Game\Task\GameTaskMasterModel;
use App\Model\Game\Task\GameTaskModel;
use App\Service\Game\TaskService;
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
 * GameTask
 * Class GameTask
 * Create With ClassGeneration
 * @ApiGroup(groupName="游戏任务")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameTask extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/Task/GameTask/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="taskMasterId",alias="主任务id",description="主任务id",lengthMax="11",optional="")
     * @Param(name="code",alias="任务编码",description="任务编码",lengthMax="32",optional="")
     * @Param(name="order",alias="排序",description="排序",lengthMax="11",optional="")
     * @Param(name="completeNum",alias="完成次数",description="完成次数",lengthMax="11",optional="")
     * @Param(name="name",alias="任务名",description="任务名",lengthMax="32",optional="")
     * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
     * @Param(name="param",alias="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]",description="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]",lengthMax="255",optional="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'taskMasterId' => $param['taskMasterId'] ?? '',
            'code'         => $param['code'] ?? '',
            'order'        => $param['order'] ?? '',
            'completeNum'  => $param['completeNum'] ?? '',
            'name'         => $param['name'] ?? '',
            'description'  => $param['description'] ?? '',
            'param'        => $param['param'] ?? '',
        ];
        $model = new GameTaskModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


    /**
     * @Api(name="update",path="/Api/User/Task/GameTask/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",required="")
     * @Param(name="taskMasterId",alias="主任务id",description="主任务id",lengthMax="11",optional="")
     * @Param(name="code",alias="任务编码",description="任务编码",lengthMax="32",optional="")
     * @Param(name="order",alias="排序",description="排序",lengthMax="11",optional="")
     * @Param(name="completeNum",alias="完成次数",description="完成次数",lengthMax="11",optional="")
     * @Param(name="name",alias="任务名",description="任务名",lengthMax="32",optional="")
     * @Param(name="description",alias="任务介绍",description="任务介绍",lengthMax="255",optional="")
     * @Param(name="param",alias="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]",description="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]",lengthMax="255",optional="")
     */
    public function update()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameTaskModel();
        $info = $model->get(['taskId' => $param['taskId']]);
        if (empty($info)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
            return false;
        }
        $updateData = [];

        $updateData['taskMasterId'] = $param['taskMasterId'] ?? $info->taskMasterId;
        $updateData['code'] = $param['code'] ?? $info->code;
        $updateData['order'] = $param['order'] ?? $info->order;
        $updateData['completeNum'] = $param['completeNum'] ?? $info->completeNum;
        $updateData['name'] = $param['name'] ?? $info->name;
        $updateData['description'] = $param['description'] ?? $info->description;
        $updateData['param'] = $param['param'] ?? $info->param;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }


    /**
     * @Api(name="getOne",path="/Api/User/Task/GameTask/getOne")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.taskId",description="任务id")
     * @ApiSuccessParam(name="result.taskMasterId",description="主任务id")
     * @ApiSuccessParam(name="result.code",description="任务编码")
     * @ApiSuccessParam(name="result.order",description="排序")
     * @ApiSuccessParam(name="result.completeNum",description="完成次数")
     * @ApiSuccessParam(name="result.name",description="任务名")
     * @ApiSuccessParam(name="result.description",description="任务介绍")
     * @ApiSuccessParam(name="result.param",description="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameTaskModel();
        $info = $model->get(['taskId' => $param['taskId']]);
        $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
    }


    /**
     * @Api(name="获取任务列表",path="/Api/User/Task/GameTask/getList")
     * @ApiDescription("获取任务列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="page", from={GET,POST}, alias="页数", optional="")
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].taskMasterId",description="主任务id")
     * @ApiSuccessParam(name="result[].type",description="1 主线任务 ")
     * @ApiSuccessParam(name="result[].name",description="任务名")
     * @ApiSuccessParam(name="result[].description",description="任务介绍")
     * @ApiSuccessParam(name="result[].order",description="排序")
     * @ApiSuccessParam(name="result[].taskInfo.taskId",description="任务id")
     * @ApiSuccessParam(name="result[].taskInfo.taskMasterId",description="主任务id")
     * @ApiSuccessParam(name="result[].taskInfo.code",description="任务编码")
     * @ApiSuccessParam(name="result[].taskInfo.order",description="排序")
     * @ApiSuccessParam(name="result[].taskInfo.completeNum",description="完成次数")
     * @ApiSuccessParam(name="result[].taskInfo.name",description="任务名")
     * @ApiSuccessParam(name="result[].taskInfo.description",description="任务介绍")
     * @ApiSuccessParam(name="result[].taskInfo.param",description="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].num",description="物品数量")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].taskId",description="任务id")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].goodsId",description="物品id")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].name",description="物品名称")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].code",description="物品code值")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].baseCode",description="物品基础类型")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].type",description="类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].description",description="介绍")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].gold",description="售出金币")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].isSale",description="是否可售出")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].level",description="等级")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].rarityLevel",description="稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话")
     * @ApiSuccessParam(name="result[].taskInfo.goodsList[].extraData",description="额外数据")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameTaskMasterModel();
        $data = $model->with(['userTaskCompleteInfo' => $this->who->userId], false)->order('`order`', 'asc')->getList(1, 9999);
        /**
         * @var $masterInfo GameTaskMasterModel
         */
        foreach ($data['list'] as $key => $masterInfo) {
            $taskModel = new GameTaskModel();
            $task = $taskModel->with(['goodsList'], false)->order('`order`', 'asc')->where('taskId',$masterInfo->userTaskCompleteInfo->nowTaskId??0,'>')->where('taskMasterId', $masterInfo->taskMasterId)->get();
            $data['list'][$key]['taskInfo'] = json_decode(json_encode($task),1);
        }
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }

    /**
     * @Api(name="complete",path="/Api/User/Task/GameTask/complete")
     * @ApiDescription("完成任务")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.taskId",description="任务id")
     * @ApiSuccessParam(name="result.taskMasterId",description="主任务id")
     * @ApiSuccessParam(name="result.code",description="任务编码")
     * @ApiSuccessParam(name="result.order",description="排序")
     * @ApiSuccessParam(name="result.completeNum",description="完成次数")
     * @ApiSuccessParam(name="result.name",description="任务名")
     * @ApiSuccessParam(name="result.description",description="任务介绍")
     * @ApiSuccessParam(name="result.param",description="任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]")
     */
    public function complete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameTaskModel();
        $info = $model->get(['taskId' => $param['taskId']]);
        Assert::assert(!!$info, '任务数据不存在');
        $userTaskMasterInfo = TaskService::getInstance()->completeTask($this->who->userId, $info);
        $this->writeJson(Status::CODE_OK, ['UserTaskCompleteInfo' => $userTaskMasterInfo], '任务完成');
    }


    /**
     * @Api(name="delete",path="/Api/User/Task/GameTask/delete")
     * @ApiDescription("删除数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="taskId",alias="任务id",description="任务id",lengthMax="11",required="")
     */
    public function delete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameTaskModel();
        $info = $model->get(['taskId' => $param['taskId']]);
        if (!$info) {
            $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
            return false;
        }

        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }
}

