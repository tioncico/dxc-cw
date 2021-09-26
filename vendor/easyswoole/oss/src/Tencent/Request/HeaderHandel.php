<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/5 0005
 * Time: 14:07
 */

namespace EasySwoole\Oss\Tencent\Request;


use EasySwoole\Oss\Tencent\Http\HttpClient;

class HeaderHandel
{
    /**
     * @var $request HttpClient
     */
    protected $request;
    protected $operation;
    protected $args;

    public function __construct($request, $operation, $args)
    {
        $this->request = $request;
        $this->operation = $operation;
        $this->args = $args;
    }

    /**
     * @return HttpClient
     */
    public function getRequest(): HttpClient
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }


    function handelParam($key, $param, $op)
    {
        $keyName = $op['sentAs']??$key;
        //额外处理
        if ($key=='Metadata'){
            if (is_array($param)){
                foreach ($param as $k=>$value){
                    $this->request->setHeader($keyName,$value);
                }
            }
        }else{
            $this->request->setHeader($keyName,$param);
        }
    }
}