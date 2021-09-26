<?php

namespace EasySwoole\UEditor;

use EasySwoole\Http\Message\UploadFile;
use EasySwoole\Http\Request;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\UEditor\Config\UploadConfig;
use EasySwoole\Utility\File;
use EasySwoole\Utility\MimeType;
use Swoole\Coroutine\System;

/**
 * Created by JetBrains PhpStorm.
 * User: taoqili
 * Date: 12-7-18
 * Time: 上午11: 32
 * UEditor编辑器通用上传类
 */
class Uploader
{
    private $fileField; //文件域名
    private $file; //文件上传对象
    private $base64; //文件上传对象
    private $config; //配置信息
    private $oriName; //原始文件名
    private $fileName; //新文件名
    private $fullName; //完整文件名,即从当前配置目录开始的URL
    private $filePath; //完整文件名,即从当前配置目录开始的URL
    private $fileSize; //文件大小
    private $fileType; //文件类型
    private $stateInfo; //上传状态信息,

    private $request;
    const UPLOAD_TYPE_UPLOAD = 1;
    const UPLOAD_TYPE_REMOTE = 2;
    const UPLOAD_TYPE_BASE64 = 3;

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array  $config 配置项
     * @param bool   $base64 是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct(UploadConfig $config, $fileField, ?Request $request = null, $type = self::UPLOAD_TYPE_UPLOAD)
    {
        $this->fileField = $fileField;
        $this->config = $config;
        $this->request = $request;

        switch ($type) {
            case self::UPLOAD_TYPE_UPLOAD:
                $this->upFile();
                break;

            case self::UPLOAD_TYPE_BASE64:
                $this->upBase64();
                break;

            case self::UPLOAD_TYPE_REMOTE:
                $this->saveRemote();
                break;
        }
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile()
    {
        $request = $this->request;
        /**
         * @var $file UploadFile
         */
        $file = $request->getUploadedFile($this->fileField);
        $this->file = $file->getStream();
        if (!$file) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return;
        }
        if ($file->getError()) {
            $this->stateInfo = $this->getStateInfo($file->getError());
            return;
        }

        $this->oriName = $file->getClientFilename();
        $this->fileSize = $file->getSize();
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        //创建目录失败
        if (!File::createDirectory($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!File::moveFile($file->getTempName(), $this->filePath)) { //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
            return;
        } else { //移动成功
            $this->stateInfo = UploadResponse::MAP_ARR[0];
        }
    }

    /**
     * 处理base64编码的图片上传
     * @return mixed
     */
    private function upBase64()
    {
        $base64Data = $this->request->getRequestParam($this->fileField);
        $img = base64_decode($base64Data);

        $this->oriName = $this->config->getOriName();
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //创建目录失败
        if (!File::createDirectory($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //写入文件
        if (!File::createFile($this->filePath, $img)) { //写入文件
            $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
        } else { //移动成功
            $this->stateInfo = UploadResponse::MAP_ARR[0];
        }
    }

    /**
     * 拉取远程图片
     * @return mixed
     */
    private function saveRemote()
    {
        $imgUrl = htmlspecialchars($this->fileField);
        $imgUrl = str_replace("&amp;", "&", $imgUrl);

        //http开头验证
        if (strpos($imgUrl, "http") !== 0) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_LINK");
            return;
        }

        preg_match('/(^https*:\/\/[^:\/]+)/', $imgUrl, $matches);
        $host_with_protocol = count($matches) > 1 ? $matches[1] : '';

        // 判断是否是合法 url
        if (!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
            $this->stateInfo = $this->getStateInfo("INVALID_URL");
            return;
        }

        preg_match('/^https*:\/\/(.+)/', $host_with_protocol, $matches);
        $host_without_protocol = count($matches) > 1 ? $matches[1] : '';

//        // 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
        $ip = System::gethostbyname($host_without_protocol);
        // 判断是否是私有 ip
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
            $this->stateInfo = $this->getStateInfo("INVALID_IP");
            return;
        }

        //获取远程图片
        $httpClient = new HttpClient($imgUrl);
        $response = $httpClient->get();
        $img = $response->getBody();
        //请求结果判断
        if (!(stristr($response->getStatusCode(), "200"))) {
            $this->stateInfo = $this->getStateInfo("ERROR_DEAD_LINK");
            return;
        }
        //格式验证(扩展名验证和Content-Type验证)
        $fileType = strtolower(strrchr($imgUrl, '.'));
        if (!in_array($fileType, $this->config->getAllowFiles()) || !isset($response->getHeaders()['content-type']) || !stristr($response->getHeaders()['content-type'], "image")) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_CONTENTTYPE");
            return;
        }


        $this->file = $img;
        preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

        $this->oriName = $m ? $m[1] : "";
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //创建目录失败
        if (!File::createDirectory($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //写入文件
        if (!File::createFile($this->filePath, $img)) { //写入文件
            $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
        } else { //移动成功
            $this->stateInfo = UploadResponse::MAP_ARR[0];
        }

    }

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !UploadResponse::MAP_ARR[$errCode] ? UploadResponse::MAP_ARR["ERROR_UNKNOWN"] : UploadResponse::MAP_ARR[$errCode];
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        $extName = strtolower(strrchr($this->oriName, '.'));
        return $extName;
    }

    /**
     * 重命名文件
     * @return string
     */
    private function getFullName()
    {
        //替换日期事件
        $t = time();
        $d = explode('-', date("Y-y-m-d-H-i-s"));
        $format = $this->config->getPathFormat();
        $format = str_replace("{yyyy}", $d[0], $format);
        $format = str_replace("{yy}", $d[1], $format);
        $format = str_replace("{mm}", $d[2], $format);
        $format = str_replace("{dd}", $d[3], $format);
        $format = str_replace("{hh}", $d[4], $format);
        $format = str_replace("{ii}", $d[5], $format);
        $format = str_replace("{ss}", $d[6], $format);
        $format = str_replace("{time}", $t, $format);

        //过滤文件名的非法自负,并替换文件名
        $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
        $oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
        $format = str_replace("{filename}", $oriName, $format);

        //替换随机字符串
        $randNum = rand(1, 10000000000) . rand(1, 10000000000);
        if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
            $format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
        }

        $ext = $this->getFileExt();
        return $format . $ext;
    }

    /**
     * 获取文件名
     * @return string
     */
    private function getFileName()
    {
        return substr($this->filePath, strrpos($this->filePath, '/') + 1);
    }

    /**
     * 获取文件完整路径
     * @return string
     */
    private function getFilePath()
    {
        $fullName = $this->fullName;
        $rootPath = $this->config->getRootPath();

        if (substr($fullName, 0, 1) != '/') {
            $fullName = '/' . $fullName;
        }

        return $rootPath . $fullName;
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array($this->getFileExt(), $this->config->getAllowFiles());
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function checkSize()
    {
        return $this->fileSize <= ($this->config->getMaxSize());
    }

    /**
     * 获取当前上传成功文件的各项信息
     */
    public function getFileInfo(): UploadResponse
    {
        $response = new UploadResponse();
        $response->setState($this->stateInfo);
        $response->setUrl($this->fullName);
        $response->setTitle($this->fileName);
        $response->setOriginal($this->oriName);
        $response->setType($this->fileType);
        $response->setSize($this->fileSize);
        return $response;
    }

}
