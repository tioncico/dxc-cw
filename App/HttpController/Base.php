<?php

namespace App\HttpController;

use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\HttpAnnotation\AnnotationController;
use EasySwoole\HttpAnnotation\Exception\Annotation\ParamValidateError;
use EasySwoole\Http\Message\Status;

/**
 * Base
 * Class Base
 * Create With ClassGeneration
 */
class Base extends AnnotationController
{
    public function index()
    {
        $this->actionNotFound('index');
    }

    public function clientRealIP($headerName = 'x-real-ip')
    {
        $server = ServerManager::getInstance()->getSwooleServer();
        $client = $server->getClientInfo($this->request()->getSwooleRequest()->fd);
        $clientAddress = $client['remote_ip'];
        $xri = $this->request()->getHeader($headerName);
        $xff = $this->request()->getHeader('x-forwarded-for');
        if ($clientAddress === '127.0.0.1') {
            if (!empty($xri)) {  // 如果有xri 则判定为前端有NGINX等代理
                $clientAddress = $xri[0];
            } elseif (!empty($xff)) {  // 如果不存在xri 则继续判断xff
                $list = explode(',', $xff[0]);
                if (!empty($list[0])) $clientAddress = $list[0];
            }
        }
        return $clientAddress;
    }
}

