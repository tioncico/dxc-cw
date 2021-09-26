<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:34
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class VideoConfig extends SplBean
{
    /* 上传视频配置 */
    protected $videoActionName = 'uploadVideo';
    protected $videoFieldName = 'upfile'; /* 提交的视频表单名称 */
    protected $videoPathFormat = '/UEditor/php/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}'; /* 上传保存路径,可以自定义保存路径和文件名格式 */
    protected $videoUrlPrefix = ''; /* 视频访问路径前缀 */
    protected $videoMaxSize = 102400000; /* 上传大小限制，单位B，默认100MB */
    protected $videoAllowFiles = ['.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',];


    /**
     * @return string
     */
    public function getVideoActionName(): string
    {
        return $this->videoActionName;
    }

    /**
     * @param string $videoActionName
     */
    public function setVideoActionName(string $videoActionName): void
    {
        $this->videoActionName = $videoActionName;
    }

    /**
     * @return string
     */
    public function getVideoFieldName(): string
    {
        return $this->videoFieldName;
    }

    /**
     * @param string $videoFieldName
     */
    public function setVideoFieldName(string $videoFieldName): void
    {
        $this->videoFieldName = $videoFieldName;
    }

    /**
     * @return string
     */
    public function getVideoPathFormat(): string
    {
        return $this->videoPathFormat;
    }

    /**
     * @param string $videoPathFormat
     */
    public function setVideoPathFormat(string $videoPathFormat): void
    {
        $this->videoPathFormat = $videoPathFormat;
    }

    /**
     * @return string
     */
    public function getVideoUrlPrefix(): string
    {
        return $this->videoUrlPrefix;
    }

    /**
     * @param string $videoUrlPrefix
     */
    public function setVideoUrlPrefix(string $videoUrlPrefix): void
    {
        $this->videoUrlPrefix = $videoUrlPrefix;
    }

    /**
     * @return int
     */
    public function getVideoMaxSize(): int
    {
        return $this->videoMaxSize;
    }

    /**
     * @param int $videoMaxSize
     */
    public function setVideoMaxSize(int $videoMaxSize): void
    {
        $this->videoMaxSize = $videoMaxSize;
    }

    /**
     * @return array
     */
    public function getVideoAllowFiles(): array
    {
        return $this->videoAllowFiles;
    }

    /**
     * @param array $videoAllowFiles
     */
    public function setVideoAllowFiles(array $videoAllowFiles): void
    {
        $this->videoAllowFiles = $videoAllowFiles;
    } /* 上传视频格式显示 */


}
