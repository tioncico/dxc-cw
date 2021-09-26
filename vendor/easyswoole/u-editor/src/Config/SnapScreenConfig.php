<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/23 0023
 * Time: 17:33
 */

namespace EasySwoole\UEditor\Config;


use EasySwoole\Spl\SplBean;

class SnapScreenConfig extends SplBean
{
    /* 截图工具上传 */
    protected $snapscreeActionName = 'uploadImage';
    protected $snapscreePathFormat = '/UEditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}'; /* 上传保存路径,可以自定义保存路径和文件名格式 */
    protected $snapscreeUrlPrefix = ''; /* 图片访问路径前缀 */
    protected $snapscreeInsertAlign = 'none';/* 插入的图片浮动方式 */

    /**
     * @return string
     */
    public function getSnapscreeActionName(): string
    {
        return $this->snapscreeActionName;
    }

    /**
     * @param string $snapscreeActionName
     */
    public function setSnapscreeActionName(string $snapscreeActionName): void
    {
        $this->snapscreeActionName = $snapscreeActionName;
    }

    /**
     * @return string
     */
    public function getSnapscreePathFormat(): string
    {
        return $this->snapscreePathFormat;
    }

    /**
     * @param string $snapscreePathFormat
     */
    public function setSnapscreePathFormat(string $snapscreePathFormat): void
    {
        $this->snapscreePathFormat = $snapscreePathFormat;
    }

    /**
     * @return string
     */
    public function getSnapscreeUrlPrefix(): string
    {
        return $this->snapscreeUrlPrefix;
    }

    /**
     * @param string $snapscreeUrlPrefix
     */
    public function setSnapscreeUrlPrefix(string $snapscreeUrlPrefix): void
    {
        $this->snapscreeUrlPrefix = $snapscreeUrlPrefix;
    }

    /**
     * @return string
     */
    public function getSnapscreeInsertAlign(): string
    {
        return $this->snapscreeInsertAlign;
    }

    /**
     * @param string $snapscreeInsertAlign
     */
    public function setSnapscreeInsertAlign(string $snapscreeInsertAlign): void
    {
        $this->snapscreeInsertAlign = $snapscreeInsertAlign;
    }


}
