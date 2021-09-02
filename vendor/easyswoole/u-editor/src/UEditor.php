<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/26 0026
 * Time: 9:48
 */

namespace EasySwoole\UEditor;


use EasySwoole\Http\Request;
use EasySwoole\Spl\SplBean;
use EasySwoole\UEditor\Config\CatcherConfig;
use EasySwoole\UEditor\Config\ImageManagerConfig;
use EasySwoole\UEditor\Config\SnapScreenConfig;
use EasySwoole\UEditor\Config\UploadConfig;
use EasySwoole\UEditor\Config\FileConfig;
use EasySwoole\UEditor\Config\FileManagerConfig;
use EasySwoole\UEditor\Config\ImageConfig;
use EasySwoole\UEditor\Config\ScrawlConfig;
use EasySwoole\UEditor\Config\VideoConfig;

class UEditor
{
    protected $rootPath;

    protected $configList = [];

    public function __construct(string $rootPath,array $configList=[])
    {
        $this->rootPath = $rootPath;
        $this->configList = $configList;
    }

    public function setConfigList(array $configList): void
    {
        foreach ($configList as $config) {
            if (is_object($config)) {
                $this->configList[get_class($config)] = $config;
                continue;
            }

            if (is_string($config) && class_exists($config)) {
                $this->configList[$config] = new $config;
                continue;
            }

            $this->configList[$config] = $config;
        }
    }

    function getConfList()
    {
        if (empty($this->configList)) {
            $defaultConfigList = [
                new CatcherConfig(),
                new FileConfig(),
                new FileManagerConfig(),
                new ImageConfig(),
                new ImageManagerConfig(),
                new ScrawlConfig(),
                new SnapScreenConfig(),
                new VideoConfig(),
            ];
            $this->setConfigList($defaultConfigList);
        }
        return $this->configList;
    }

    function getConfig()
    {
        $list = [];

        $configList = $this->getConfList();
        /**
         * @var $config SplBean
         */
        foreach ($configList as $config) {
            $list = array_merge($list, $config->toArray());
        }

        return $list;
    }

    /**
     * 上传图片
     * uploadImage
     * @param Request $request
     * @param ImageConfig $imageConfig
     * @param UploadConfig $uploadConfig
     * @return UploadResponse
     * @author Tioncico
     * Time: 10:04
     */
    function uploadImage($request, ?ImageConfig $imageConfig = null, ?UploadConfig $uploadConfig = null): UploadResponse
    {
        $uploadConfig = $uploadConfig ?? new UploadConfig(['rootPath' => $this->rootPath]);
        $imageConfig = $imageConfig ?? $this->getConfList()[ImageConfig::class];
        $uploadConfig->setPathFormat($imageConfig->getImagePathFormat());
        $uploadConfig->setMaxSize($imageConfig->getImageMaxSize());
        $uploadConfig->setAllowFiles($imageConfig->getImageAllowFiles());
        $uploader = new Uploader($uploadConfig, $imageConfig->getImageFieldName(), $request, Uploader::UPLOAD_TYPE_UPLOAD);
        return $uploader->getFileInfo();
    }

    /**
     * 上传涂鸦
     * uploadScrawl
     * @param Request $request
     * @param ScrawlConfig $scrawlConfig
     * @param UploadConfig $uploadConfig
     * @return UploadResponse
     * @author Tioncico
     * Time: 10:04
     */
    function uploadScrawl($request, ?ScrawlConfig $scrawlConfig = null, ?UploadConfig $uploadConfig = null): UploadResponse
    {
        $uploadConfig = $uploadConfig ?? new UploadConfig(['rootPath' => $this->rootPath]);
        $scrawlConfig = $scrawlConfig ?? $this->getConfList()[ScrawlConfig::class];
        $uploadConfig->setPathFormat($scrawlConfig->getScrawlPathFormat());
        $uploadConfig->setMaxSize($scrawlConfig->getScrawlMaxSize());
        $uploadConfig->setAllowFiles($scrawlConfig->getScrawlAllowFiles());
        $uploadConfig->setOriName('scrawl.png');
        $uploader = new Uploader($uploadConfig, $scrawlConfig->getScrawlFieldName(), $request, Uploader::UPLOAD_TYPE_BASE64);
        return $uploader->getFileInfo();
    }

    function uploadVideo($request, ?VideoConfig $videoConfig = null, ?UploadConfig $uploadConfig = null): UploadResponse
    {
        $uploadConfig = $uploadConfig ?? new UploadConfig(['rootPath' => $this->rootPath]);
        $videoConfig = $videoConfig ?? $this->getConfList()[VideoConfig::class];
        $uploadConfig->setPathFormat($videoConfig->getVideoPathFormat());
        $uploadConfig->setMaxSize($videoConfig->getVideoMaxSize());
        $uploadConfig->setAllowFiles($videoConfig->getVideoAllowFiles());
        $uploader = new Uploader($uploadConfig, $videoConfig->getVideoFieldName(), $request, Uploader::UPLOAD_TYPE_UPLOAD);
        return $uploader->getFileInfo();

    }

    function uploadFile($request, ?FileConfig $fileConfig = null, ?UploadConfig $uploadConfig = null): UploadResponse
    {
        $uploadConfig = $uploadConfig ?? new UploadConfig(['rootPath' => $this->rootPath]);
        $fileConfig = $fileConfig ?? $this->getConfList()[FileConfig::class];
        $uploadConfig->setPathFormat($fileConfig->getFilePathFormat());
        $uploadConfig->setMaxSize($fileConfig->getFileMaxSize());
        $uploadConfig->setAllowFiles($fileConfig->getFileAllowFiles());
        $uploader = new Uploader($uploadConfig, $fileConfig->getFileFieldName(), $request, Uploader::UPLOAD_TYPE_UPLOAD);
        return $uploader->getFileInfo();
    }

    function listImage(?ImageManagerConfig $imageManagerConfig = null, $page = 1, $pageSize = 20): FileListResponse
    {
        $imageManagerConfig = $imageManagerConfig ?? $this->getConfList()[ImageManagerConfig::class];
        $fileManager = new FileManager($this->rootPath, $imageManagerConfig->getImageManagerListPath(), $imageManagerConfig->getImageManagerAllowFiles());
        return $fileManager->getFileList(($page - 1) * $pageSize, $pageSize);
    }

    function listFile(?FileManagerConfig $fileManagerConfig = null, $page = 1, $pageSize = 20)
    {
        $fileManagerConfig = $fileManagerConfig ?? $this->getConfList()[FileManagerConfig::class];
        $fileManager = new FileManager($this->rootPath, $fileManagerConfig->getFileManagerListPath(), $fileManagerConfig->getFileManagerAllowFiles());
        return $fileManager->getFileList(($page - 1) * $pageSize, $pageSize);
    }

    function catchImage(?CatcherConfig $catcherConfig, $remoteList = [], ?UploadConfig $uploadConfig = null)
    {
        $catcherConfig = $catcherConfig ?? $this->getConfList()[CatcherConfig::class];
        $uploadConfig = $uploadConfig ?? new UploadConfig(['rootPath' => $this->rootPath]);
        $uploadConfig->setPathFormat($catcherConfig->getCatcherPathFormat());
        $uploadConfig->setMaxSize($catcherConfig->getCatcherMaxSize());
        $uploadConfig->setAllowFiles($catcherConfig->getCatcherAllowFiles());
        $uploadConfig->setOriName('remote.png');

        $list = [];
        foreach ($remoteList as $imgUrl) {
            $item = new Uploader($uploadConfig, $imgUrl, null, Uploader::UPLOAD_TYPE_REMOTE);
            $info = $item->getFileInfo();
            array_push($list, $info);
        }

        /* 返回抓取数据 */
        return [
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list' => $list
        ];
    }
}
