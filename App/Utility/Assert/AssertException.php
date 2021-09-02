<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-26
 * Time: 09:54
 */

namespace App\Utility\Assert;


class AssertException extends \Exception
{
    protected $errorCode;

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorCode(?string $errorCode):AssertException
    {
        $this->errorCode = $errorCode;
        return $this;
    }
}
