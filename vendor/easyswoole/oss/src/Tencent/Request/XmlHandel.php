<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/6 0006
 * Time: 12:00
 */

namespace EasySwoole\Oss\Tencent\Request;

use EasySwoole\Oss\Tencent\Http\HttpClient;
use \XMLWriter;


class XmlHandel
{
    /**
     * @var $request HttpClient
     */
    protected $request;
    protected $operation;
    /**
     * @var $xml XMLWriter
     */
    protected $xml;
    protected $xmlData;
    protected $params;
    protected $isXml = false;

    function __construct($request, $operation, $params)
    {
        $this->operation = $operation;
        $this->params = $params;
        $this->request = $request;

        $opArr = $this->getOperation();
        $this->xml = $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'utf-8');
        if (isset($opArr['data']['xmlRoot']['name'])&&$opArr['data']['xmlRoot']['name']) {
            $xml->startElement($opArr['data']['xmlRoot']['name']);
        }
    }

    /**
     * @return bool
     */
    public function isXml(): bool
    {
        return $this->isXml;
    }


    function getXmlData()
    {
        if ($this->isXml == true) {
            $xml = $this->xml;
            $xml->endElement();
            $this->xmlData = $this->xml->outputMemory();
            return $this->xmlData;
        } else {
            return null;
        }
    }


    function handelParam($key, $param, $op)
    {
        $this->isXml = true;
        $this->request->setHeader('Content-Type', 'application/xml', false);
        $this->handelXmlElement($op['type'], $key, $param, $op);
    }

    /**
     * 处理数组类型
     * handelArray
     * @param           $paramName
     * @param           $param
     * @param           $op
     * @author Tioncico
     * Time: 10:22
     */
    protected function handelArray($paramName, $param, $op)
    {
        foreach ($param as $key => $value) {
            $this->handelXmlElement($op['type'], $key, $value, $op);
        }
    }

    /**
     * 处理对象类型
     * handelObject
     * @param           $paramName
     * @param           $params
     * @param           $op
     * @author Tioncico
     * Time: 10:22
     */
    protected function handelObject($paramName, $params, $op)
    {
        //先遍历属性值
        foreach ($params as $key => $value) {
            $keyName = $op[$key]['sentAs'] ?? $key;
            if (empty($op[$key]['data']['xmlAttribute'])) {
                continue;
            }
            $this->handelXmlElement($op[$key]['type'], $keyName, $value, $op[$key]);
        }
        //再遍历正常属性
        foreach ($params as $key => $value) {
            $keyName = $op[$key]['sentAs'] ?? $key;
            if (!empty($op[$key]['data']['xmlAttribute'])) {
                continue;
            }
            $this->handelXmlElement($op[$key]['type'], $keyName, $value, $op[$key]);
        }
    }

    /**
     * 处理字符串类型
     * handelString
     * @param           $value
     * @author Tioncico
     * Time: 10:22
     */
    protected function handelString($keyName, $value, $op)
    {
        $xml = $this->xml;
        if (isset($op['data'])&&$op['data']) {
            if ($op['data']['xmlAttribute']) {
                $xml->writeAttribute($op['sentAs'] ?? $keyName, $value);
            }
        } else {
            $xml->startElement($op['sentAs'] ?? $keyName);
            $xml->text($value);
            $xml->endElement();
        }
    }

    /**
     * 调度处理类型
     * handelXmlElement
     * @param           $type
     * @param           $keyName
     * @param           $value
     * @param           $op
     * @author Tioncico
     * Time: 10:22
     */
    function handelXmlElement($type, $keyName, $value, $op)
    {
        $xml = $this->xml;
        if ($type == 'object') {
            $xml->startElement($op['sentAs']??$op['name'] ?? $keyName);
            if (isset($op['data']['xmlNamespace'])) {
                $xml->writeAttribute('xmlns:xsi', $op['data']['xmlNamespace']);
            }
            $this->handelObject($keyName, $value, $op['properties']);
            $xml->endElement();
        } elseif ($type == 'array') {
            if (isset($op['sentAs'])&&$op['sentAs']){
                $xml->startElement($op['sentAs']);
            }
            if (isset($op['data']['xmlNamespace'])&&$op['data']['xmlNamespace']) {
                $xml->writeAttribute('xmlns:xsi', $op['data']['xmlNamespace']);
            }
            $this->handelArray($keyName, $value, $op['items']);
            if (isset($op['sentAs'])&&$op['sentAs']){
                $xml->endElement();
            }
        } elseif ($type == 'string' || $type == 'numeric') {
            $this->handelString($keyName, $value, $op);
        }
    }

    function getOperation()
    {
        return $this->operation;
    }

}
