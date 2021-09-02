<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-26
 * Time: 09:52
 */

namespace App\Utility\Assert;


class Assert
{

    static function assert($condition, $msg, ?int $errorCode = null): bool
    {
        if ($condition !== true) {
            throw (new AssertException($msg))->setErrorCode($errorCode);
        }
        return true;
    }

}
