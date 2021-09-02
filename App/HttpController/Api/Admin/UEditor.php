<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/27 0027
 * Time: 16:55
 */

namespace App\HttpController\Api\Admin;


use App\Utility\Assert\Assert;
use App\Utility\OssClient;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\Message\Status;
use EasySwoole\Http\Message\UploadFile;
use EasySwoole\HttpAnnotation\Annotation\ParserInterface;
use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\UEditor\Config\CatcherConfig;
use EasySwoole\UEditor\Config\FileConfig;
use EasySwoole\UEditor\Config\FileManagerConfig;
use EasySwoole\UEditor\Config\ImageConfig;
use EasySwoole\UEditor\Config\ImageManagerConfig;
use EasySwoole\UEditor\Config\ScrawlConfig;
use EasySwoole\UEditor\Config\SnapScreenConfig;
use EasySwoole\UEditor\Config\VideoConfig;
use EasySwoole\UEditor\UEditor as UEditorComponent;
use EasySwoole\UEditor\Uploader;
use EasySwoole\UEditor\UploadResponse;
use EasySwoole\Utility\File;

class UEditor extends AdminBase
{
    protected $rootPath = EASYSWOOLE_ROOT . '/Upload';

    protected static $configList = [];

    /** @var UEditorComponent*/
    protected $UEditor;

    public function __construct(?ParserInterface $parser=null)
    {
        $this->UEditor = new UEditorComponent($this->rootPath);
        $host = Config::getInstance()->getConf('ALI_OSS.HOST').'/';

        $catcherConfig = new CatcherConfig();
        $catcherConfig->setCatcherUrlPrefix($host);
        $fileConfig = new FileConfig();
        $fileConfig->setFileUrlPrefix($host);
        $fileManagerConfig = new FileManagerConfig();
        $fileManagerConfig->setFileManagerUrlPrefix($host);
        $imageConfig = new ImageConfig();
        $imageConfig->setImageUrlPrefix($host);
        $imageManagerConfig = new ImageManagerConfig();
        $imageManagerConfig->setImageManagerUrlPrefix($host);
        $scrawlConfig = new ScrawlConfig();
        $scrawlConfig->setScrawlUrlPrefix($host);
        $snapScreenConfig = new SnapScreenConfig();
        $snapScreenConfig->setSnapscreeUrlPrefix($host);
        $videoConfig = new VideoConfig();
        $videoConfig->setVideoUrlPrefix($host);

        $configList = [
            $catcherConfig,
            $fileConfig,
            $fileManagerConfig,
            $imageConfig,
            $imageManagerConfig,
            $scrawlConfig,
            $snapScreenConfig,
            $videoConfig,
        ];
        $this->UEditor->setConfigList($configList);

        parent::__construct($parser);
    }

    function index()
    {
        $action = $this->request()->getRequestParam('action');
        $this->runAction($action);
    }


    protected function runAction($actionName)
    {
        switch ($actionName) {
            case "config":
                $this->config();
                break;
            case "uploadImage":
                $this->uploadImage();
                break;
            case "uploadScrawl":
                $this->uploadScrawl();
                break;
            case "catchImage":
                $this->catchImage();
                break;
            case "uploadVideo":
                $this->uploadVideo();
                break;
            case "uploadFile":
                $this->uploadFile();
                break;
            case "listImage":
                $this->listImage();
                break;
            case "listFile":
                $this->listFile();
                break;

        }

    }

    protected function catchImage()
    {
        $catchImageConfig = new CatcherConfig();
        $field = $catchImageConfig->getCatcherFieldName();
        $remoteList = $this->request()->getRequestParam($field);
        $result = $this->UEditor->catchImage($catchImageConfig, $remoteList);
        $this->writeData($result);
    }

    protected function uploadImage()
    {
        $result = $this->UEditor->uploadImage($this->request());
//        $fileInfo = $this->uploadOss($result);
//        unlink($this->rootPath.$result->getUrl());
//        $result->setUrl($fileInfo['path']);
//        $result->setTitle($fileInfo['title']);
        $this->writeData($result);
    }

    protected function uploadScrawl()
    {
        $result = $this->UEditor->uploadScrawl($this->request());
//        $fileInfo = $this->uploadOss($result);
//        unlink($this->rootPath.$result->getUrl());
//        $result->setUrl($fileInfo['path']);
//        $result->setTitle($fileInfo['title']);

        $this->writeData($result);
    }

    protected function uploadVideo()
    {
        $result = $this->UEditor->uploadVideo($this->request());
//        $fileInfo = $this->uploadOss($result);
//        unlink($this->rootPath.$result->getUrl());
//        $result->setUrl($fileInfo['path']);
//        $result->setTitle($fileInfo['title']);

        $this->writeData($result);
    }

    protected function uploadFile()
    {
        $result = $this->UEditor->uploadFile($this->request());
        $this->writeData($result);
    }

    protected function listImage()
    {
        $result = $this->UEditor->listImage();
        $this->writeData($result);
    }

    protected function listFile()
    {
        $result = $this->UEditor->listFile();
        $this->writeData($result);
    }

    protected function config()
    {
        $this->writeData($this->UEditor->getConfig());
    }

    protected function writeData($result)
    {
        $data = json_encode($result);
        $callback = $this->request()->getRequestParam('callback');
        if (empty($callback)) {
            $this->response()->write($data);
            return true;
        }
        if (preg_match("/^[\w_]+$/", $callback)) {
            $this->response()->write(htmlspecialchars($callback) . '(' . $data . ')');
        } else {
            $this->response()->write(json_encode([
                'state' => 'callback参数不合法'
            ]));
        }
    }

    protected function uploadOss(UploadResponse $file){
        $client = new OssClient();
        $title = date('H:i:s').mt_rand(10000,99999)."{$file->getTitle()}";
        $path = "UEditorImg/".date('Ymd')."/".$title;

        try {
            $client->aliOssClient()->putObject($client->getOssBucket(), $path,file_get_contents($this->rootPath.$file->getUrl()));
        } catch (OssException $e) {
            Assert::assert(false,'文件上传失败');
        }

        return ['path' =>$path,'title'=> $title];
    }
}
