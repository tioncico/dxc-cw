<?php

namespace App\HttpController\Api\Admin;

use App\Model\Game\MailModel;
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
 * Mail
 * Class Mail
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.Mail")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Mail extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/Mail/add")
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
		    'id'=>$param['id'],
		    'userId'=>$param['userId'],
		    'name'=>$param['name'],
		    'msg'=>$param['msg'],
		    'addTime'=>$param['addTime'],
		    'isRead'=>$param['isRead'],
		    'isReceive'=>$param['isReceive'],
		    'isDelete'=>$param['isDelete'],
		];
		$model = new MailModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/Mail/update")
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

		$updateData['userId']=$param['userId'] ?? $info->userId;
		$updateData['name']=$param['name'] ?? $info->name;
		$updateData['msg']=$param['msg'] ?? $info->msg;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$updateData['isRead']=$param['isRead'] ?? $info->isRead;
		$updateData['isReceive']=$param['isReceive'] ?? $info->isReceive;
		$updateData['isDelete']=$param['isDelete'] ?? $info->isDelete;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/Mail/getOne")
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
	 * @Api(name="getList",path="/Api/Admin/Mail/getList")
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
	 * @ApiSuccessParam(name="result[].userId",description="用户id")
	 * @ApiSuccessParam(name="result[].name",description="邮件标题")
	 * @ApiSuccessParam(name="result[].msg",description="邮件内容")
	 * @ApiSuccessParam(name="result[].addTime",description="发送时间")
	 * @ApiSuccessParam(name="result[].isRead",description="是否已读")
	 * @ApiSuccessParam(name="result[].isReceive",description="是否已接收")
	 * @ApiSuccessParam(name="result[].isDelete",description="是否删除")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new MailModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/Mail/delete")
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
		$model = new MailModel();
		$info = $model->get(['id' => $param['id']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

