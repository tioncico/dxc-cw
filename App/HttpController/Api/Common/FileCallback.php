<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/4/18 0018
 * Time: 11:18
 */

namespace App\HttpController\Api\Common;


use App\HttpController\Api\Common\CommonBase;
use App\Service\Common\OssService;
use App\Utility\Assert\Assert;
use App\Utility\OssClient;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\Message\Status;
use EasySwoole\Http\Message\UploadFile;
use EasySwoole\Log\Logger;
use EasySwoole\Oss\AliYun\OssConst;
use EasySwoole\Validate\Validate;


class FileCallback extends CommonBase
{
    /**
     * @api {get|post} /Api/Common/FileCallback/fileCallback
     */
    function fileCallback()
    {
        if (OssService::getInstance()->ossCallback($this->request())) {
            $data = $this->request()->getRequestParam();
            try {
                $oss = new OssClient();
                $ossClient = $oss->aliOssClient();
                $ossBucket = $oss->getOssBucket();
                $ossClient->putObjectAcl($ossBucket, $data['filename'], OssConst::OSS_ACL_TYPE_PUBLIC_READ);
            } catch (\Throwable $e) {
                $this->writeJson(Status::CODE_BAD_REQUEST, [], $e->getMessage());
            }
            $data = [
                "Status" => "Ok",
                'path'     => Config::getInstance()->getConf('ALI_OSS')['HOST'].'/'.$data['filename'],
                "fileName" => $data['filename']
            ];
            $this->writeJson(Status::CODE_OK,$data,'上传成功');
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST,[],'上传失败');
        }
    }
}
