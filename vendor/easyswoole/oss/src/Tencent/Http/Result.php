<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/3 0003
 * Time: 11:44
 */

namespace EasySwoole\Oss\Tencent\Http;


use EasySwoole\HttpClient\Bean\Response;

class Result implements \ArrayAccess
{
    public $Location = 'service.cos.myqcloud.com/';

    protected $xmlData=null;

    function __construct(Response $response, array $operationsResult)
    {
        $this->handelData($response, $operationsResult);
    }


    function handelData(Response $response, array $operationsResult)
    {
        $body = $response->getBody();

        //现在看上去只有object
        if ($operationsResult['additionalProperties']) {
            $this->addProperties($response, $operationsResult['properties']);
        }
    }

    function addProperties(Response $response, $properties)
    {
        foreach ($properties as $key => $property) {
            $propertyValue = [];
            switch ($property['location']) {
                case "xml":
                    $propertyValue = $this->getXmlData($response,$key);
                    break;
                case "header":
                    $propertyValue = $response->getHeaders()[strtolower($property['sentAs']??$key)]??null;
                    break;
                case "body":
                    if ($property['instanceOf']){
                        $propertyValue = new $property['instanceOf']($response->getBody());
                    }else{
                        $propertyValue = $response->getBody();
                    }

                    break;
            }
            if (isset($property['type'])&&$property['type'] == 'array') {
                $this->$key[] = $propertyValue;
            }elseif (isset($property['type'])&&$property['type'] == 'object'){
                $this->$key = $propertyValue;
            } else {
                $this->$key = $propertyValue;
            }
        }
    }

    protected function getXmlData($response,$key){
        if ($this->xmlData===null){
            $xmlBody = simplexml_load_string($response->getBody());
            $jsonData = json_encode($xmlBody);
            $body = json_decode($jsonData, true);
            $this->xmlData = $body;
        }
        return $this->xmlData[$key]??null;
    }


    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }


}
