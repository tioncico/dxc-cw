<?php

namespace App\HttpController\Api\Admin;

use App\Model\User\UserModel;
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
 * User
 * Class User
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/Admin.User")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class User extends AdminBase
{
	/**
	 * @Api(name="add",path="/Api/Admin/User/add")
	 * @ApiDescription("新增数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",required="")
	 * @Param(name="account",alias="辣蹦号",description="辣蹦号",lengthMax="16",required="")
	 * @Param(name="nickname",alias="昵称",description="昵称",lengthMax="50",required="")
	 * @Param(name="password",alias="密码",description="密码",lengthMax="255",required="")
	 * @Param(name="phone",alias="手机号",description="手机号",lengthMax="16",required="")
	 * @Param(name="avatar",alias="头像地址",description="头像地址",lengthMax="255",required="")
	 * @Param(name="addTime",alias="创建的时间",description="创建的时间",required="")
	 * @Param(name="state",alias="状态",description="状态",lengthMax="1",required="",defaultValue="1")
	 */
	public function add()
	{
		$param = ContextManager::getInstance()->get('param');
		$data = [
		    'userId'=>$param['userId'],
		    'account'=>$param['account'],
		    'nickname'=>$param['nickname'],
		    'password'=>$param['password'],
		    'phone'=>$param['phone'],
		    'avatar'=>$param['avatar'],
		    'addTime'=>$param['addTime'],
		    'state'=>$param['state'],
		];
		$model = new UserModel($data);
		$model->save();
		$this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
	}


	/**
	 * @Api(name="update",path="/Api/Admin/User/update")
	 * @ApiDescription("更新数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
	 * @Param(name="userId",required="")
	 * @Param(name="account",alias="辣蹦号",description="辣蹦号",lengthMax="16",optional="")
	 * @Param(name="nickname",alias="昵称",description="昵称",lengthMax="50",optional="")
	 * @Param(name="password",alias="密码",description="密码",lengthMax="255",optional="")
	 * @Param(name="phone",alias="手机号",description="手机号",lengthMax="16",optional="")
	 * @Param(name="avatar",alias="头像地址",description="头像地址",lengthMax="255",optional="")
	 * @Param(name="addTime",alias="创建的时间",description="创建的时间",optional="")
	 * @Param(name="state",alias="状态",description="状态",lengthMax="1",optional="",defaultValue="1")
	 */
	public function update()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserModel();
		$info = $model->get(['userId' => $param['userId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['account']=$param['account'] ?? $info->account;
		$updateData['nickname']=$param['nickname'] ?? $info->nickname;
		$updateData['password']=$param['password'] ?? $info->password;
		$updateData['phone']=$param['phone'] ?? $info->phone;
		$updateData['avatar']=$param['avatar'] ?? $info->avatar;
		$updateData['addTime']=$param['addTime'] ?? $info->addTime;
		$updateData['state']=$param['state'] ?? $info->state;
		$info->update($updateData);
		$this->writeJson(Status::CODE_OK, $info, "更新数据成功");
	}


	/**
	 * @Api(name="getOne",path="/Api/Admin/User/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userId",required="")
	 * @ApiSuccessParam(name="result.userId",description="")
	 * @ApiSuccessParam(name="result.account",description="辣蹦号")
	 * @ApiSuccessParam(name="result.nickname",description="昵称")
	 * @ApiSuccessParam(name="result.password",description="密码")
	 * @ApiSuccessParam(name="result.phone",description="手机号")
	 * @ApiSuccessParam(name="result.avatar",description="头像地址")
	 * @ApiSuccessParam(name="result.addTime",description="创建的时间")
	 * @ApiSuccessParam(name="result.state",description="状态")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserModel();
		$info = $model->get(['userId' => $param['userId']]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}


	/**
	 * @Api(name="getList",path="/Api/Admin/User/getList")
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
	 * @ApiSuccessParam(name="result[].userId",description="")
	 * @ApiSuccessParam(name="result[].account",description="辣蹦号")
	 * @ApiSuccessParam(name="result[].nickname",description="昵称")
	 * @ApiSuccessParam(name="result[].password",description="密码")
	 * @ApiSuccessParam(name="result[].phone",description="手机号")
	 * @ApiSuccessParam(name="result[].avatar",description="头像地址")
	 * @ApiSuccessParam(name="result[].addTime",description="创建的时间")
	 * @ApiSuccessParam(name="result[].state",description="状态")
	 */
	public function getList()
	{
		$param = ContextManager::getInstance()->get('param');
		$page = (int)($param['page'] ?? 1);
		$pageSize = (int)($param['pageSize'] ?? 20);
		$model = new UserModel();
		$data = $model->getList($page, $pageSize);
		$this->writeJson(Status::CODE_OK, $data, '获取列表成功');
	}


	/**
	 * @Api(name="delete",path="/Api/Admin/User/delete")
	 * @ApiDescription("删除数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
	 * @Param(name="userId",required="")
	 */
	public function delete()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserModel();
		$info = $model->get(['userId' => $param['userId']]);
		if (!$info) {
		    $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
		}

		$info->destroy();
		$this->writeJson(Status::CODE_OK, [], "删除成功.");
	}
}

