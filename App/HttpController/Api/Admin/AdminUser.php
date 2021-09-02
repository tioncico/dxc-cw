<?php

namespace App\HttpController\Api\Admin;

use App\Model\Admin\AdminUserModel;
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
 * AdminUser
 * Class AdminUser
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.AdminUser")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class AdminUser extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/AdminUser/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="adminName",alias="昵称",description="昵称",lengthMax="32",required="")
	 * @Param(name="adminAccount",alias="账号",description="账号",lengthMax="32",required="")
	 * @Param(name="adminPassword",alias="密码",description="密码",lengthMax="32",required="")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'adminName'=>$param['adminName'],
		    'adminAccount'=>$param['adminAccount'],
		    'adminPassword'=>$param['adminPassword'],
		    'addTime'=>time(),
		];
		$model = new AdminUserModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/AdminUser/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="adminId",alias="id",description="id",required="")
	 * @Param(name="adminName",alias="昵称",description="昵称",lengthMax="32",optional="")
	 * @Param(name="adminAccount",alias="账号",description="账号",lengthMax="32",optional="")
	 * @Param(name="adminPassword",alias="密码",description="密码",lengthMax="32",optional="")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AdminUserModel();
		$info = $model->get(['adminId' => $param['adminId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['adminName']=$param['adminName'] ?? $info->adminName;
		$updateData['adminAccount']=$param['adminAccount'] ?? $info->adminAccount;
		$updateData['adminPassword']= (isset($param['adminPassword'])?$info::hashPassword($param['adminPassword']):$info->adminPassword);
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/AdminUser/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="adminId",alias="id",description="id",required="")
	 * @ApiSuccessParam(name="result.adminId",description="id")
	 * @ApiSuccessParam(name="result.adminName",description="昵称")
	 * @ApiSuccessParam(name="result.adminAccount",description="账号")
	 * @ApiSuccessParam(name="result.adminPassword",description="密码")
	 * @ApiSuccessParam(name="result.addTime",description="创建时间")
	 * @ApiSuccessParam(name="result.lastLoginTime",description="上次登陆的时间")
	 * @ApiSuccessParam(name="result.lastLoginIp",description="上次登陆的Ip")
	 * @ApiSuccessParam(name="result.adminSession",description="")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AdminUserModel();
		$info = $model->get(['adminId' => $param['adminId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/AdminUser/getList")
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
	 * @ApiSuccessParam(name="result[].adminId",description="id")
	 * @ApiSuccessParam(name="result[].adminName",description="昵称")
	 * @ApiSuccessParam(name="result[].adminAccount",description="账号")
	 * @ApiSuccessParam(name="result[].adminPassword",description="密码")
	 * @ApiSuccessParam(name="result[].addTime",description="创建时间")
	 * @ApiSuccessParam(name="result[].lastLoginTime",description="上次登陆的时间")
	 * @ApiSuccessParam(name="result[].lastLoginIp",description="上次登陆的Ip")
	 * @ApiSuccessParam(name="result[].adminSession",description="")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new AdminUserModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/AdminUser/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="adminId",alias="id",description="id",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new AdminUserModel();
		$info = $model->get(['adminId' => $param['adminId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

