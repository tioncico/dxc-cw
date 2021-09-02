<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:32
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class FileConfig extends SplBean
{
    /* 上传文件配置 */
    protected $fileActionName = 'uploadFile';
    protected $fileFieldName = 'upfile'; /* 提交的文件表单名称 */
    protected $filePathFormat = '/UEditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand:6}';/* 上传保存路径,可以自定义保存路径和文件名格式 */
    protected $fileUrlPrefix = ''; /* 文件访问路径前缀 */
    protected $fileMaxSize = 51200000; /* 上传大小限制，单位B，默认50MB */
    protected $fileAllowFiles = ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid', '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml',
    ];

    /**
     * @return mixed
     */
    public function getFileActionName()
    {
        return $this->fileActionName;
    }

    /**
     * @param mixed $fileActionName
     */
    public function setFileActionName($fileActionName): void
    {
        $this->fileActionName = $fileActionName;
    }


    /**
     * @return string
     */
    public function getFileFieldName(): string
    {
        return $this->fileFieldName;
    }

    /**
     * @param string $fileFieldName
     */
    public function setFileFieldName(string $fileFieldName): void
    {
        $this->fileFieldName = $fileFieldName;
    }

    /**
     * @return string
     */
    public function getFilePathFormat(): string
    {
        return $this->filePathFormat;
    }

    /**
     * @param string $filePathFormat
     */
    public function setFilePathFormat(string $filePathFormat): void
    {
        $this->filePathFormat = $filePathFormat;
    }

    /**
     * @return string
     */
    public function getFileUrlPrefix(): string
    {
        return $this->fileUrlPrefix;
    }

    /**
     * @param string $fileUrlPrefix
     */
    public function setFileUrlPrefix(string $fileUrlPrefix): void
    {
        $this->fileUrlPrefix = $fileUrlPrefix;
    }

    /**
     * @return int
     */
    public function getFileMaxSize(): int
    {
        return $this->fileMaxSize;
    }

    /**
     * @param int $fileMaxSize
     */
    public function setFileMaxSize(int $fileMaxSize): void
    {
        $this->fileMaxSize = $fileMaxSize;
    }

    /**
     * @return array
     */
    public function getFileAllowFiles(): array
    {
        return $this->fileAllowFiles;
    }

    /**
     * @param array $fileAllowFiles
     */
    public function setFileAllowFiles(array $fileAllowFiles): void
    {
        $this->fileAllowFiles = $fileAllowFiles;
    } /* 上传文件格式显示 */


}
