<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:32
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class ScrawlConfig extends SplBean
{

    /* 涂鸦图片上传配置项 */
    protected $scrawlActionName='uploadScrawl';
    protected $scrawlFieldName = 'upfile';/* 提交的图片表单名称 */
    protected $scrawlPathFormat = '/UEditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}';/* 上传保存路径,可以自定义保存路径和文件名格式 */
    protected $scrawlMaxSize = 2048000;/* 上传大小限制，单位B */
    protected $scrawlUrlPrefix = '';/* 图片访问路径前缀 */
    protected $scrawlInsertAlign = 'none';
    protected $scrawlAllowFiles = ['.png', '.jpg', '.jpeg', '.gif', '.bmp',];


    /**
     * @return string
     */
    public function getScrawlActionName(): string
    {
        return $this->scrawlActionName;
    }

    /**
     * @param string $scrawlActionName
     */
    public function setScrawlActionName(string $scrawlActionName): void
    {
        $this->scrawlActionName = $scrawlActionName;
    }

    /**
     * @return string
     */
    public function getScrawlFieldName(): string
    {
        return $this->scrawlFieldName;
    }

    /**
     * @param string $scrawlFieldName
     */
    public function setScrawlFieldName(string $scrawlFieldName): void
    {
        $this->scrawlFieldName = $scrawlFieldName;
    }

    /**
     * @return string
     */
    public function getScrawlPathFormat(): string
    {
        return $this->scrawlPathFormat;
    }

    /**
     * @param string $scrawlPathFormat
     */
    public function setScrawlPathFormat(string $scrawlPathFormat): void
    {
        $this->scrawlPathFormat = $scrawlPathFormat;
    }

    /**
     * @return int
     */
    public function getScrawlMaxSize(): int
    {
        return $this->scrawlMaxSize;
    }

    /**
     * @param int $scrawlMaxSize
     */
    public function setScrawlMaxSize(int $scrawlMaxSize): void
    {
        $this->scrawlMaxSize = $scrawlMaxSize;
    }

    /**
     * @return string
     */
    public function getScrawlUrlPrefix(): string
    {
        return $this->scrawlUrlPrefix;
    }

    /**
     * @param string $scrawlUrlPrefix
     */
    public function setScrawlUrlPrefix(string $scrawlUrlPrefix): void
    {
        $this->scrawlUrlPrefix = $scrawlUrlPrefix;
    }

    /**
     * @return string
     */
    public function getScrawlInsertAlign(): string
    {
        return $this->scrawlInsertAlign;
    }

    /**
     * @param string $scrawlInsertAlign
     */
    public function setScrawlInsertAlign(string $scrawlInsertAlign): void
    {
        $this->scrawlInsertAlign = $scrawlInsertAlign;
    }

    /**
     * @return array
     */
    public function getScrawlAllowFiles(): array
    {
        return $this->scrawlAllowFiles;
    }

    /**
     * @param array $scrawlAllowFiles
     */
    public function setScrawlAllowFiles(array $scrawlAllowFiles): void
    {
        $this->scrawlAllowFiles = $scrawlAllowFiles;
    }


}
