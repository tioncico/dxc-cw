<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/5 0005
 * Time: 14:07
 */

namespace EasySwoole\Oss\Tencent\Request;


use EasySwoole\Oss\Tencent\Http\HttpClient;

class RequestHandel
{
    /**
     * @var $request HttpClient
     */
    protected $request;
    protected $operation;
    protected $args;
    protected $defaultRequestLocations = [
        'body'      => 'bodyHandel',
        'query'     => 'queryHandel',
        'header'    => 'headerHandel',
        'json'      => 'jsonHandel',
        'xml'       => 'xmlHandel',
        'formParam' => 'formParamHandel',
        'multipart' => 'multipartHandel',
    ];

    /**
     * @var BodyHandel $bodyHandel
     */
    protected $bodyHandel;
    protected $queryHandel;
    protected $headerHandel;
    protected $jsonHandel;
    protected $xmlHandel;
    protected $formParamHandel;
    protected $multipartHandel;

    public function __construct($request, $operation, $args)
    {
        $this->request = $request;
        $this->operation = $operation;
        $this->args = $args;

        $this->xmlHandel = new XmlHandel($request,$this->operation, $this->args);
        $this->headerHandel = new HeaderHandel($request, $this->operation, $this->args);
        $this->bodyHandel = new BodyHandel($request,$this->operation, $this->args);
        $this->queryHandel = new QueryHandel($request,$this->operation, $this->args);

    }

    function handel()
    {
        $args = $this->args;
        $opArr = $this->getOperation();
        $data = [];
        foreach ($args as $key => $arg) {
            $op = $this->operation['parameters'][$key]??null;
            if ($op === null) {
                continue;
            }
            $handelClass = $this->defaultRequestLocations[$op['location']]??null;
            if ($handelClass === null) {
                continue;
            }
            $this->$handelClass->handelParam($key, $arg, $op);
        }

        $xmlData = $this->xmlHandel->getXmlData();
        if ($xmlData){
            $this->request->setRequestBody($xmlData);
        }
        $bodyData = $this->bodyHandel->getData();
        if ($bodyData){
            $this->request->setRequestBody($bodyData);
        }

    }

    /**
     * @return mixed
     */
    public function getOperation()
    {
        return $this->operation;
    }

}
