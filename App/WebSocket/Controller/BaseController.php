<?php


namespace App\WebSocket\Controller;


use App\WebSocket\Cache\UserFdMap;
use EasySwoole\Socket\AbstractInterface\Controller;

class BaseController extends Controller
{
    public function userId(){
       return UserFdMap::getInstance()->getFdUserId($this->caller()->getClient()->getFd());
    }

    public function getParam(){
        $param = $this->caller()->getArgs();
        return $param;
    }

}
