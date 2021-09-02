<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/26
 * Time: 5:39 PM
 */

namespace App\HttpController\Api\Admin;

use App\HttpController\Api\ApiBase;
use App\Model\Admin\AdminModel;
use App\Model\Admin\AdminUserModel;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\Message\Status;
use EasySwoole\HttpAnnotation\Exception\Annotation\ParamValidateError;

class AdminBase extends ApiBase
{
    protected $noneAuthAction = [];

    /**
     * @var AdminUserModel
     */
    public $who;

    const ADMIN_TOKEN_NAME = 'admin_token';


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

    protected function who(): ?AdminUserModel
    {
        if (!$this->who) {
            /*
             * 执行session检查
             * 获取session信息
             */
            $session = $this->getRequestAndCookieParam(self::ADMIN_TOKEN_NAME);
            if (empty($session)) {
                return null;
            }

            // 通过session查找用户
            $who = AdminUserModel::create()->get(['adminSession' => $session]);
            $this->who = $who;
            return $who;
        }
        return $this->who;
    }

}

