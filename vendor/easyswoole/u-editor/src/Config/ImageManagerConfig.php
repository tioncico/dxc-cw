<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:36
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class ImageManagerConfig extends SplBean
{
    /* 列出指定目录下的图片 */
    protected $imageManagerActionName = 'listImage';
    protected $imageManagerListPath = '/UEditor/php/upload/image/'; /* 指定要列出图片的目录 */
    protected $imageManagerListSize = 20; /* 每次列出文件数量 */
    protected $imageManagerUrlPrefix = ''; /* 图片访问路径前缀 */
    protected $imageManagerInsertAlign = 'none'; /* 插入的图片浮动方式 */
    protected $imageManagerAllowFiles = ['.png', '.jpg', '.jpeg', '.gif', '.bmp',];

    /**
     * @return string
     */
    public function getImageManagerActionName(): string
    {
        return $this->imageManagerActionName;
    }

    /**
     * @param string $imageManagerActionName
     */
    public function setImageManagerActionName(string $imageManagerActionName): void
    {
        $this->imageManagerActionName = $imageManagerActionName;
    }


    /**
     * @return string
     */
    public function getImageManagerListPath(): string
    {
        return $this->imageManagerListPath;
    }

    /**
     * @param string $imageManagerListPath
     */
    public function setImageManagerListPath(string $imageManagerListPath): void
    {
        $this->imageManagerListPath = $imageManagerListPath;
    }

    /**
     * @return int
     */
    public function getImageManagerListSize(): int
    {
        return $this->imageManagerListSize;
    }

    /**
     * @param int $imageManagerListSize
     */
    public function setImageManagerListSize(int $imageManagerListSize): void
    {
        $this->imageManagerListSize = $imageManagerListSize;
    }

    /**
     * @return string
     */
    public function getImageManagerUrlPrefix(): string
    {
        return $this->imageManagerUrlPrefix;
    }

    /**
     * @param string $imageManagerUrlPrefix
     */
    public function setImageManagerUrlPrefix(string $imageManagerUrlPrefix): void
    {
        $this->imageManagerUrlPrefix = $imageManagerUrlPrefix;
    }

    /**
     * @return string
     */
    public function getImageManagerInsertAlign(): string
    {
        return $this->imageManagerInsertAlign;
    }

    /**
     * @param string $imageManagerInsertAlign
     */
    public function setImageManagerInsertAlign(string $imageManagerInsertAlign): void
    {
        $this->imageManagerInsertAlign = $imageManagerInsertAlign;
    }

    /**
     * @return array
     */
    public function getImageManagerAllowFiles(): array
    {
        return $this->imageManagerAllowFiles;
    }

    /**
     * @param array $imageManagerAllowFiles
     */
    public function setImageManagerAllowFiles(array $imageManagerAllowFiles): void
    {
        $this->imageManagerAllowFiles = $imageManagerAllowFiles;
    } /* 列出的文件类型 */



}
