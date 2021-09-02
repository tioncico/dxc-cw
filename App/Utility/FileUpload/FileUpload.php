<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-06-19
 * Time: 16:00
 */

namespace App\Utility\FileUpload;

use App\Utility\Assert\Assert;
use App\Utility\OssClient;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\Message\UploadFile;
use EasySwoole\Utility\File;
use EasySwoole\Utility\MimeType;

class FileUpload
{
    use Singleton;

    const UPLOAD_PATH = EASYSWOOLE_ROOT . '/Upload';
    const UPLOAD_TYPE_TEMP = 'Temp';

    /**
     * 保存文件
     * saveFile
     * @param             $dir
     * @param             $tempName
     * @param string|null $extensionName
     * @param string      $uploadType
     * @return string
     * @author tioncico
     * Time: 下午5:14
     */
    function saveFile($dir, $tempName, ?string $extensionName = null, string $uploadType = '')
    {
        try {
            $fileName = md5(uniqid());
            $path = "/" . date('Ymd') . "/" . date('H');

            if ($extensionName) {
                $saveFullPath = $path . "/{$fileName}.{$extensionName}";
            } else {
                $saveFullPath = $path . "/{$fileName}";
            }
            File::moveFile($tempName, $dir . $saveFullPath);
            return $uploadType . $saveFullPath;
        } catch (\Throwable $throwable) {
            Trigger::getInstance()->throwable($throwable);
        }
    }

    /**
     * 控制器调用上传文件
     * uploadFile
     * @param UploadFile $file
     * @author tioncico
     * Time: 17:01
     */
    function uploadFile(UploadFile $file, string $uploadType)
    {
        $extensionName = substr(strrchr($file->getClientFilename(), '.'), 1);
        $path = $this->saveFile(self::UPLOAD_PATH . "/$uploadType", $file->getTempName(), $extensionName ?? null, $uploadType);
        return $path;
    }

    /**
     * 移动临时文件
     * @param $filePath
     * @param $fileType
     * @return string|cnull
     * @throws \App\Utility\Assert\AssertExeption
     */
    function moveFilePath($filePath, $fileType): ?string
    {
        //如果本身就为空,则不上传
        if (empty($filePath)) {
            return '';
        }
        //先验证文件是否为临时文件,如果不等于临时文件前缀,则不做移动
        if (substr($filePath, 0, strlen(self::UPLOAD_TYPE_TEMP)) != self::UPLOAD_TYPE_TEMP) {
            return null;
        }
        //验证临时文件是否存在
        if (!file_exists(self::UPLOAD_PATH . '/' . $filePath)) {
            Assert::assert(false, '文件数据异常,请重新上传');
        }
        try {
            $extensionName = substr(strrchr($filePath, '.'), 1);
            $path = $this->copyFile(self::UPLOAD_PATH . "/{$fileType}", self::UPLOAD_PATH . '/' . $filePath, $extensionName, $fileType);
            return $path;
        } catch (\Throwable $throwable) {
            Assert::assert(false, '文件数据异常,请重新上传');
            return null;
        }
    }

    /**
     * 复制文件
     * copyFile
     * @param             $dir
     * @param             $tempName
     * @param string|null $extensionName
     * @param string      $uploadType
     * @return string
     * @author tioncico
     * Time: 下午5:15
     */
    function copyFile($dir, $tempName, ?string $extensionName = null, string $uploadType = '')
    {
        try {
            $fileName = md5(uniqid());
            $path = "/" . date('Ymd') . "/" . date('H');

            if ($extensionName) {
                $saveFullPath = $path . "/{$fileName}.{$extensionName}";
            } else {
                $saveFullPath = $path . "/{$fileName}";
            }
            File::copyFile($tempName, $dir . $saveFullPath);
            return $uploadType . $saveFullPath;
        } catch (\Throwable $throwable) {
            Trigger::getInstance()->throwable($throwable);
        }
    }
}
