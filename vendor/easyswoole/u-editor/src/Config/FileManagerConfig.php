<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:36
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class FileManagerConfig extends SplBean
{

    /* 列出指定目录下的文件 */
    protected $fileManagerActionName = 'listFile';
    protected $fileManagerListPath = '/UEditor/php/upload/file/'; /* 指定要列出文件的目录 */
    protected $fileManagerUrlPrefix = ''; /* 文件访问路径前缀 */
    protected $fileManagerListSize = 20; /* 每次列出文件数量 */
    protected $fileManagerAllowFiles = ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid', '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml',];

    /**
     * @return string
     */
    public function getFileManagerListPath(): string
    {
        return $this->fileManagerListPath;
    }

    /**
     * @param string $fileManagerListPath
     */
    public function setFileManagerListPath(string $fileManagerListPath): void
    {
        $this->fileManagerListPath = $fileManagerListPath;
    }

    /**
     * @return string
     */
    public function getFileManagerUrlPrefix(): string
    {
        return $this->fileManagerUrlPrefix;
    }

    /**
     * @param string $fileManagerUrlPrefix
     */
    public function setFileManagerUrlPrefix(string $fileManagerUrlPrefix): void
    {
        $this->fileManagerUrlPrefix = $fileManagerUrlPrefix;
    }

    /**
     * @return int
     */
    public function getFileManagerListSize(): int
    {
        return $this->fileManagerListSize;
    }

    /**
     * @param int $fileManagerListSize
     */
    public function setFileManagerListSize(int $fileManagerListSize): void
    {
        $this->fileManagerListSize = $fileManagerListSize;
    }

    /**
     * @return array
     */
    public function getFileManagerAllowFiles(): array
    {
        return $this->fileManagerAllowFiles;
    }

    /**
     * @param array $fileManagerAllowFiles
     */
    public function setFileManagerAllowFiles(array $fileManagerAllowFiles): void
    {
        $this->fileManagerAllowFiles = $fileManagerAllowFiles;
    }/* 列出的文件类型 */


}
