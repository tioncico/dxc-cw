<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/3 0003
 * Time: 15:46
 */

namespace EasySwoole\Oss\Tencent\Http;


class Command implements \ArrayAccess
{
    /** @var string */
    private $name;
    public $data;

    public function __construct($name, array $args = [])
    {
        $this->name = $name;
        $this->data = $args;
    }

    public function getName()
    {
        return $this->name;
    }

    public function hasParam($name)
    {
        return array_key_exists($name, $this->data);
    }



    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        return $this->data[$offset]  =$value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

}
