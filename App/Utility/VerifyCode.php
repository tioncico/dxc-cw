<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-29
 * Time: 16:41
 */

namespace App\Utility;


class VerifyCode
{
    const COOKIE_CODE_HASH = 'verifyCodeHash';
    const COOKIE_CODE_TIME = 'verifyCodeTime';
    const VERIFY_CODE_LENGTH = 4;

    const TTL = 5 * 60;

    static function checkCode($verifyCodeHash, $verifyCodeTime, $verifyCode)
    {
        //判断是否过期
        if ($verifyCodeTime + self::TTL < time()) {
            return false;
        }
        $code = strtolower($verifyCode);
        return md5($code . $verifyCodeTime) == $verifyCodeHash;
    }

}
