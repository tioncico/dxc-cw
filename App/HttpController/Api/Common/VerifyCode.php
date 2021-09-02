<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-25
 * Time: 13:46
 */

namespace App\HttpController\Api\Common;

use EasySwoole\Http\Message\Status;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\Utility\Random;
use EasySwoole\VerifyCode\Conf;
use EasySwoole\VerifyCode\VerifyCode as VerifyCodeModel;

/**
 * Class VerifyCode
 * @package App\HttpController\Api\Common
 * @ApiGroup(groupName="Api.Common.VerifyCode")
 * @ApiGroupDescription("随机验证码")
 */
class VerifyCode extends CommonBase
{

    /**
     * @Api(name="verifyCode",path="/Api/Common/VerifyCode/verifyCode")
     * @ApiDescription("验证码生成")
     */
    function verifyCode()
    {
        $ttl = \App\Utility\VerifyCode::TTL;
        $conf = new Conf();
        $VCode = new VerifyCodeModel($conf);
        // 随机生成验证码
        $randomCode = Random::character(\App\Utility\VerifyCode::VERIFY_CODE_LENGTH, '1234567890abcdefhijklmnprstuvwxy');
        $code = $VCode->DrawCode($randomCode);
        $time = time();
        $codeHash = md5($randomCode . $time);
        $result = [
            'verifyCode'           => $code->getImageBase64(),
            \App\Utility\VerifyCode::COOKIE_CODE_TIME => $time,
            \App\Utility\VerifyCode::COOKIE_CODE_HASH => $codeHash
        ];

        $this->response()->setCookie(\App\Utility\VerifyCode::COOKIE_CODE_HASH, $codeHash, $time + $ttl, '/');
        $this->response()->setCookie(\App\Utility\VerifyCode::COOKIE_CODE_TIME, $time, $time + $ttl, '/');
        $this->writeJson(Status::CODE_OK, $result, '验证码生成成功');
    }
}
