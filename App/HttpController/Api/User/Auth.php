<?php


namespace App\HttpController\Api\User;


use App\Model\User\UserModel;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Http\Message\Status;
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
use EasySwoole\Utility\Random;

class Auth extends UserBase
{
    protected $noneAuthAction = ['login'];

    /**
     * @Api(name="login",path="/Api/User/Auth/login")
     * @ApiDescription("用户登录")
     * @Param(name="account",required="",description="密码")
     * @Param(name="password",required="",description="账号")
     * @ApiRequestExample("curl http://127.0.0.1:9501/Api/Admin/Auth/login?account=123456&password=e10adc3949ba59abbe56e057f20f883e")
     * @ApiSuccess({"code":200,"result":{"adminId":1,"adminName":"zyx","adminAccount":"123456","addTime":0,"lastLoginTime":1596530015,"lastLoginIp":"192.168.0.122","adminSession":"b2187eb9f20fb327"},"msg":"登陆信息"})
     * @author xdd
     * Time: 16:03
     */
    function login($account, $password)
    {
        $userInfo = UserModel::create()->where(['account' => $account, 'password' => UserModel::hashPassword($password)])->get();
        Assert::assert(!!$userInfo, "账号或密码错误");
        $session = Random::character(32);
        $userInfo->update([
            'session'       => $session
        ]);
        $userInfo = $userInfo->toArray();
        $this->response()->setCookie(self::USER_TOKEN_NAME, $session, time() + 86400 * 7, '/');
        $this->writeJson(Status::CODE_OK, $userInfo, "登陆信息");
    }

    /**
     * @Api(name="logout",path="/Api/User/Auth/logout")
     * @ApiDescription("用户登出")
     * @ApiRequestExample("curl http://127.0.0.1:9501/Api/Admin/Auth/logout")
     * @ApiSuccess({"code":200,"result":true,"msg":"注销成功"})
     * @author xdd
     * Time: 16:03
     */
    function logout()
    {
        $userInfo = $this->who();
        $result = $userInfo->logout();
        $this->writeJson(Status::CODE_OK, $result, "注销成功");
    }

    /**
     * @Api(path="/Api/User/Auth/getInfo",name="getInfo")
     */
    function getInfo()
    {
        $this->writeJson(Status::CODE_OK, $this->who(), '获取信息成功');
    }

}
