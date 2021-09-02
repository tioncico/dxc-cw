<?php


namespace App\HttpController\Api\Admin;


use App\Model\Admin\AdminUserModel;
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

class Auth extends AdminBase
{
    protected $noneAuthAction = ['login'];

    /**
     * @Api(name="login",path="/Api/Admin/Auth/login")
     * @ApiDescription("管理员登录")
     * @Param(name="adminAccount",required="",description="密码")
     * @Param(name="adminPassword",required="",description="账号")
     * @Param(name="adminPassword",required="",description="账号")
     * @Param(name="verifyCodeHash", description="验证码验证hash",required="")
     * @Param(name="verifyCodeTime", description="验证码生成时间",required="")
     * @Param(name="verifyCode", alias="验证码值", required="", length="4")`
     * @ApiRequestExample("curl http://127.0.0.1:9501/Api/Admin/Auth/login?account=123456&password=e10adc3949ba59abbe56e057f20f883e")
     * @ApiSuccess({"code":200,"result":{"adminId":1,"adminName":"zyx","adminAccount":"123456","addTime":0,"lastLoginTime":1596530015,"lastLoginIp":"192.168.0.122","adminSession":"b2187eb9f20fb327"},"msg":"登陆信息"})
     * @author xdd
     * Time: 16:03
     */
    function login($adminAccount, $adminPassword)
    {
        Assert::assert($this->checkVerify(),"验证码错误");
        $admin = AdminUserModel::create()->where(['adminAccount' => $adminAccount, 'adminPassword' => AdminUserModel::hashPassword($adminPassword)])->get();
        Assert::assert(!!$admin, "账号或密码错误");
        $time = time();
        $session = Random::character(32);
        $admin->update([
            'lastLoginTime' => $time,
            'lastLoginIp'   => $this->clientRealIP(),
            'adminSession'       => $session
        ]);
        $this->response()->setCookie(self::ADMIN_TOKEN_NAME, $session, time() + 86400 * 7, '/');
        $this->writeJson(Status::CODE_OK, $admin, "登陆信息");
    }

    /**
     * @Api(name="logout",path="/Api/Admin/Auth/logout")
     * @ApiDescription("管理员登出")
     * @ApiRequestExample("curl http://127.0.0.1:9501/Api/Admin/Auth/logout")
     * @ApiSuccess({"code":200,"result":true,"msg":"注销成功"})
     * @author xdd
     * Time: 16:03
     */
    function logout()
    {
        $admin = $this->who();
        $result = $admin->logout();
        $this->writeJson(Status::CODE_OK, $result, "注销成功");
    }

    /**
     * @Api(path="/Api/Admin/Auth/getInfo",name="getInfo")
     */
    function getInfo()
    {
        $this->writeJson(Status::CODE_OK, $this->who(), '获取信息成功');
    }


    /**
     * @Api(name="checkVerify")
     * @Param(name="verifyCode", alias="验证码值", required="", length="4")
     * @Param(name="verifyCodeHash",description="验证码验证hash,cookie中保存", from={COOKIE,GET,POST}, required="")
     * @Param(name="verifyCodeTime",description="验证码生成时间,cookie中保存", from={COOKIE,GET,POST}, required="")
     */
    protected function checkVerify()
    {
        $verifyCodeHash = $this->request()->getCookieParams(\App\Utility\VerifyCode::COOKIE_CODE_HASH);
        $verifyCodeTime = $this->request()->getCookieParams(\App\Utility\VerifyCode::COOKIE_CODE_TIME);

        $verifyCodeHash = $verifyCodeHash ?? $this->request()->getRequestParam(\App\Utility\VerifyCode::COOKIE_CODE_HASH);
        $verifyCodeTime = $verifyCodeTime ?? $this->request()->getRequestParam(\App\Utility\VerifyCode::COOKIE_CODE_TIME);

        $param = $this->request()->getRequestParam();
        $verifyCode = $param['verifyCode'];
        $ttl = 5 * 60;
        //调用后，cookie失效
        $this->response()->setCookie(\App\Utility\VerifyCode::COOKIE_CODE_HASH, null, -1);
        $this->response()->setCookie(\App\Utility\VerifyCode::COOKIE_CODE_TIME, null, -1);
        //判断是否过期
        if ($verifyCodeTime + $ttl < time()) {
            return false;
        }
        $code = strtolower($verifyCode);
        return md5($code . $verifyCodeTime) == $verifyCodeHash;
    }
}
