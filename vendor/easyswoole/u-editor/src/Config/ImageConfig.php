<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:32
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class ImageConfig extends SplBean
{
    /* 上传图片配置项 */
    protected $imageActionName='uploadImage';
    protected $imageFieldName = 'upfile';/* 提交的图片表单名称 */
    protected $imageMaxSize = 2048000;/* 上传大小限制，单位B */
    protected $imageAllowFiles = ['.png', '.jpg', '.jpeg', '.gif', '.bmp',];/* 上传图片格式显示 */
    protected $imageCompressEnable = true; /* 是否压缩图片,默认是true */
    protected $imageCompressBorder = 1600; /* 图片压缩最长边限制 */
    protected $imageInsertAlign = 'none'; /* 插入的图片浮动方式 */
    protected $imageUrlPrefix = ''; /* 图片访问路径前缀 */
    protected $imagePathFormat = '/UEditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}';

    /*上传保存路径,可以自定义保存路径和文件名格式
     {filename} 会替换成原文件名,配置这项需要注意中文乱码问题
     {rand:6} 会替换成随机数,后面的数字是随机数的位数
     {time} 会替换成时间戳
     {yyyy} 会替换成四位年份
     {yy} 会替换成两位年份
     {mm} 会替换成两位月份
     {dd} 会替换成两位日期
     {hh} 会替换成两位小时
     {ii} 会替换成两位分钟
     {ss} 会替换成两位秒
     非法字符 \ : * ? " < > |
     具请体看线上文档: fex.baidu.com/UEditor/#use-format_upload_filename */


    /**
     * @return string
     */
    public function getImageActionName(): string
    {
        return $this->imageActionName;
    }

    /**
     * @param string $imageActionName
     */
    public function setImageActionName(string $imageActionName): void
    {
        $this->imageActionName = $imageActionName;
    }

    /**
     * @return string
     */
    public function getImageFieldName(): string
    {
        return $this->imageFieldName;
    }

    /**
     * @param string $imageFieldName
     */
    public function setImageFieldName(string $imageFieldName): void
    {
        $this->imageFieldName = $imageFieldName;
    }

    /**
     * @return int
     */
    public function getImageMaxSize(): int
    {
        return $this->imageMaxSize;
    }

    /**
     * @param int $imageMaxSize
     */
    public function setImageMaxSize(int $imageMaxSize): void
    {
        $this->imageMaxSize = $imageMaxSize;
    }

    /**
     * @return array
     */
    public function getImageAllowFiles(): array
    {
        return $this->imageAllowFiles;
    }

    /**
     * @param array $imageAllowFiles
     */
    public function setImageAllowFiles(array $imageAllowFiles): void
    {
        $this->imageAllowFiles = $imageAllowFiles;
    }

    /**
     * @return bool
     */
    public function isImageCompressEnable(): bool
    {
        return $this->imageCompressEnable;
    }

    /**
     * @param bool $imageCompressEnable
     */
    public function setImageCompressEnable(bool $imageCompressEnable): void
    {
        $this->imageCompressEnable = $imageCompressEnable;
    }

    /**
     * @return int
     */
    public function getImageCompressBorder(): int
    {
        return $this->imageCompressBorder;
    }

    /**
     * @param int $imageCompressBorder
     */
    public function setImageCompressBorder(int $imageCompressBorder): void
    {
        $this->imageCompressBorder = $imageCompressBorder;
    }

    /**
     * @return string
     */
    public function getImageInsertAlign(): string
    {
        return $this->imageInsertAlign;
    }

    /**
     * @param string $imageInsertAlign
     */
    public function setImageInsertAlign(string $imageInsertAlign): void
    {
        $this->imageInsertAlign = $imageInsertAlign;
    }

    /**
     * @return string
     */
    public function getImageUrlPrefix(): string
    {
        return $this->imageUrlPrefix;
    }

    /**
     * @param string $imageUrlPrefix
     */
    public function setImageUrlPrefix(string $imageUrlPrefix): void
    {
        $this->imageUrlPrefix = $imageUrlPrefix;
    }

    /**
     * @return string
     */
    public function getImagePathFormat(): string
    {
        return $this->imagePathFormat;
    }

    /**
     * @param string $imagePathFormat
     */
    public function setImagePathFormat(string $imagePathFormat): void
    {
        $this->imagePathFormat = $imagePathFormat;
    }

}
