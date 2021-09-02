<?php


namespace App\HttpController\Api\Admin;


use App\Service\Common\OssService;
use App\Utility\Assert\Assert;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\Message\Status;
use EasySwoole\Http\Message\UploadFile;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccess;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;

/**
 * Class FileUpload
 * @package App\HttpController\Api\Admin
 * @ApiGroup(groupName="Api.Admin.FileUpload")
 * @ApiDescription("公共控制器")
 */
class FileUpload extends AdminBase
{
    /**
     * @Api(path="Api/Admin/FileUpload/getSign",name="getSign")
     */
    public function getSign()
    {
        $res = OssService::getInstance()->getSign();
        $this->writeJson(Status::CODE_OK, $res, '获取sign成功');
    }

    /**
     * @Api(path="/Api/User/FileUpload/getAppStsSign",name="getAppStsSign")
     * @ApiGroupDescription("App sts鉴权数据返回")
     * @ApiSuccess({"StatusCode":200,"AccessKeyId":"STS.NTbZL3JZL6fPZVtT3HcESniFU","AccessKeySecret":"CjQPSn12pVWoJByHg2GGZLWs9wJWkxefyYVT7CuxiFA3","SecurityToken":"CAIShQJ1q6Ft5B2yfSjIr5fXEfaHp4VtgaS7WHDFsDMdb8p\/gazttzz2IH5NeXZsCOkWt\/k2nWBR6vgdlqJ4T55IQ1Dza8J148yyaJENz8yT1fau5Jko1beHewHKeTOZsebWZ+LmNqC\/Ht6md1HDkAJq3LL+bk\/Mdle5MJqP+\/UFB5ZtKWveVzddA8pMLQZPsdITMWCrVcygKRn3mGHdfiEK00he8Toms\/3gmJTGt0KE0gCqkrYvyt6vcsT+Xa5FJ4xiVtq55utye5fa3TRYgxowr\/kv0fMYqG6X54zEWgkIv0vZKZnd9tx+MQl+fbMmHK1Jqvfxk\/Bis\/DUjZ7wzxtdnHyfnv0x0+kagAF0fM7XyRj1TMMoLlOlvALW0gE36ojhyewOe8HJLRDQuvUEBWJzsMNjHAC+Z\/bDcS8c7rVoNiayl5qYM3AD2hRrIfLd9k\/Ce9\/FqlHmSNHwo3QxYK\/WBv6G28ULg1nGDELZBanzyVPGjVtB3HFPGnnxdk0n5qOs\/oQWpxwB74QyEA==","Expiration":"2020-09-01T07:43:15Z"})
     */
    public function getAppStsSign()
    {
        $data = OssService::getInstance()->getSts();
        $this->response()->write(json_encode($data));
    }

    /**
     * @Api(path="/Api/Admin/FileUpload/upload",name="uploadFile")
     * @ApiGroupDescription("上传文件到本地")
     * @Param(name="file",from={FILE},required="",allowFile={"jpg","png","jpeg","txt","doc","docx"})
     */
    function uploadFile(UploadFile $file)
    {
        $path = \App\Utility\FileUpload\FileUpload::getInstance()->uploadFile($file, \App\Utility\FileUpload\FileUpload::UPLOAD_TYPE_TEMP);
        Assert::assert($path !== false, '文件上传失败!');
        $webHost = (Config::getInstance()->getConf('WEB.SSL') ? 'https://' : 'http://') . (Config::getInstance()->getConf('WEB.HOST') ?? '');
        $this->writeJson(Status::CODE_OK, ['path' => $path, 'fullPath' => $webHost . $path], '文件上传成功!');
    }
}
