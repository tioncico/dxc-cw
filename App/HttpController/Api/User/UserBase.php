<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/26
 * Time: 5:39 PM
 */

namespace App\HttpController\Api\User;

use App\HttpController\Api\ApiBase;
use App\Model\User\UserModel;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\Message\Status;
use EasySwoole\HttpAnnotation\Exception\Annotation\ParamValidateError;

class UserBase extends ApiBase
{
    protected $noneAuthAction = [];

    /**
     * @var UserModel
     */
    public $who;

    const USER_TOKEN_NAME = 'user_token';


    function onRequest(?string $action): ?bool
    {
        if (parent::onRequest($action) === false) {
            return false;
        }

        if (!in_array($action, $this->noneAuthAction) && !$this->who()) {
            $this->writeJson(Status::CODE_UNAUTHORIZED, null, '请登录');
            return false;
        }
        return true;
    }

    protected function who(): ?UserModel
    {
        if (!$this->who) {
            /*
             * 执行session检查
             * 获取session信息
             */
            $session = $this->getRequestAndCookieParam(self::USER_TOKEN_NAME);
            if (empty($session)) {
                return null;
            }

            // 通过session查找用户
            $who = UserModel::create()->get(['session' => $session]);
            $this->who = $who;
            return $who;
        }
        return $this->who;
    }

}

