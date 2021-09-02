<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 15:39
 */

namespace EasySwoole\UEditor\Config;

use EasySwoole\Spl\SplBean;

class UploadConfig extends SplBean
{
    //新增的配置项
    protected $rootPath = EASYSWOOLE_ROOT;

    /* 前后端通信相关的配置*/
    protected $pathFormat;
    protected $maxSize;
    protected $allowFiles;
    protected $oriName;

    /**
     * @return bool|string
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param bool|string $rootPath
     */
    public function setRootPath($rootPath): void
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @return mixed
     */
    public function getPathFormat()
    {
        return $this->pathFormat;
    }

    /**
     * @param mixed $pathFormat
     */
    public function setPathFormat($pathFormat): void
    {
        $this->pathFormat = $pathFormat;
    }

    /**
     * @return mixed
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param mixed $maxSize
     */
    public function setMaxSize($maxSize): void
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return mixed
     */
    public function getAllowFiles()
    {
        return $this->allowFiles;
    }

    /**
     * @param mixed $allowFiles
     */
    public function setAllowFiles($allowFiles): void
    {
        $this->allowFiles = $allowFiles;
    }

    /**
     * @return mixed
     */
    public function getOriName()
    {
        return $this->oriName;
    }

    /**
     * @param mixed $oriName
     */
    public function setOriName($oriName): void
    {
        $this->oriName = $oriName;
    }

}
