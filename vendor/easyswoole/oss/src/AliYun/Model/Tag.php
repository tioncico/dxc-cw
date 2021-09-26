<?php

namespace EasySwoole\Oss\AliYun\Model;

/**
 * Class Tag
 * @package EasySwoole\Oss\AliYun\Model
 */
class Tag
{
    /**
     * Tag constructor.
     *
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    private $key = "";
    private $value = "";
}
