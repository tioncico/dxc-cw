<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/5 0005
 * Time: 14:07
 */

namespace EasySwoole\Oss\Tencent\Request;


use EasySwoole\Oss\Tencent\Http\HttpClient;
use EasySwoole\Spl\SplFileStream;
use EasySwoole\Spl\SplStream;

class BodyHandel
{
    /**
     * @var $request HttpClient
     */
    protected $request;
    protected $operation;
    protected $args;
    protected $data=null;
    protected $isData=false;

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
        $this->isData=true;
        if ($param instanceof SplStream){
            $this->data = $param->__toString();
        }else{
            $stream = new SplStream($param);
            $this->data = $stream->__toString();
        }
    }

    function getData(){
        if ($this->isData===false){
            return null;
        }
        return $this->data;
    }
}