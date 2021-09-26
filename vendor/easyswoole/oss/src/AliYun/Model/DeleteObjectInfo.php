<?php

namespace EasySwoole\Oss\AliYun\Model;
use EasySwoole\Oss\AliYun\Core\OssException;

/**
 * Class DeleteObjectInfo
 * @package EasySwoole\Oss\AliYun\Model
 */
class DeleteObjectInfo
{
    /**
     * DeleteObjectInfo constructor.
     *
     * @param string $key
     * @param string $versionId
     */
    public function __construct($key, $versionId = '')
    {
        $this->key = $key;
        $this->versionId = $versionId;
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
    public function getVersionId()
    {
        return $this->versionId;
    }

    private $key = "";
    private $versionId = "";
}
