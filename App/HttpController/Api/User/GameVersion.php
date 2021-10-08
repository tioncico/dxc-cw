<?php

namespace App\HttpController\Api\User;

use App\Model\Game\GameVersionModel;
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
 * GameVersion
 * Class GameVersion
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.GameVersion")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class GameVersion extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/GameVersion/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="versionId",alias="版本id",description="版本id",lengthMax="11",optional="")
     * @Param(name="description",alias="版本介绍",description="版本介绍",lengthMax="512",optional="")
     * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
     * @Param(name="url",alias="下载地址",description="下载地址",lengthMax="255",optional="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'versionId'   => $param['versionId'] ?? '',
            'description' => $param['description'] ?? '',
            'addTime'     => $param['addTime'] ?? '',
            'url'         => $param['url'] ?? '',
        ];
        $model = new GameVersionModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


    /**
     * @Api(name="update",path="/Api/User/GameVersion/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="id",lengthMax="11",required="")
     * @Param(name="versionId",alias="版本id",description="版本id",lengthMax="11",optional="")
     * @Param(name="description",alias="版本介绍",description="版本介绍",lengthMax="512",optional="")
     * @Param(name="addTime",alias="新增时间",description="新增时间",lengthMax="11",optional="")
     * @Param(name="url",alias="下载地址",description="下载地址",lengthMax="255",optional="")
     */
    public function update()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameVersionModel();
        $info = $model->get(['id' => $param['id']]);
        if (empty($info)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
            return false;
        }
        $updateData = [];

        $updateData['versionId'] = $param['versionId'] ?? $info->versionId;
        $updateData['description'] = $param['description'] ?? $info->description;
        $updateData['addTime'] = $param['addTime'] ?? $info->addTime;
        $updateData['url'] = $param['url'] ?? $info->url;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }


    /**
     * @Api(name="获取最后版本",path="/Api/User/GameVersion/getLastVersion")
     * @ApiDescription("获取最后版本")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @ApiSuccessParam(name="result.id",description="")
     * @ApiSuccessParam(name="result.versionId",description="版本id")
     * @ApiSuccessParam(name="result.description",description="版本介绍")
     * @ApiSuccessParam(name="result.addTime",description="新增时间")
     * @ApiSuccessParam(name="result.url",description="下载地址")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameVersionModel();
        $info = $model->order('versionId', 'DESC')->get();
        $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
    }


    /**
     * @Api(name="getList",path="/Api/User/GameVersion/getList")
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
     * @ApiSuccessParam(name="result[].id",description="")
     * @ApiSuccessParam(name="result[].versionId",description="版本id")
     * @ApiSuccessParam(name="result[].description",description="版本介绍")
     * @ApiSuccessParam(name="result[].addTime",description="新增时间")
     * @ApiSuccessParam(name="result[].url",description="下载地址")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 20);
        $model = new GameVersionModel();

        $data = $model->getList($page, $pageSize);
        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }


    /**
     * @Api(name="delete",path="/Api/User/GameVersion/delete")
     * @ApiDescription("删除数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="id",lengthMax="11",required="")
     */
    public function delete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new GameVersionModel();
        $info = $model->get(['id' => $param['id']]);
        if (!$info) {
            $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
            return false;
        }

        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }
}

