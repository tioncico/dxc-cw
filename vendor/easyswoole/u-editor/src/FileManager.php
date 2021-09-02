<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/26 0026
 * Time: 10:21
 */

namespace EasySwoole\UEditor;


class FileManager
{
    protected $allowFiles = [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ];
    protected $path;
    protected $rootPath;

    public function __construct($rootPath, $path, $allowFiles = null)
    {
        $this->allowFiles = $allowFiles ?? $this->allowFiles;
        $this->path = $path;
        $this->rootPath = $rootPath;
    }

    function getFileList(int $start = 0, int $size = 20)
    {
        $allowFiles = substr(str_replace(".", "|", join("", $this->allowFiles)), 1);

        /* 获取参数 */
        $end = $start + $size;

        $path = $this->path;
        /* 获取文件列表 */
        $path = $this->rootPath . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
        $files = $this->getFiles($path, $allowFiles);

        if (!count($files)) {
            $response = new FileListResponse();
            $response->setState("no match file");
            $response->setList([]);
            $response->setStart($start);
            $response->setTotal(0);
            return $response;
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }
//倒序
//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
//    $list[] = $files[$i];
//}

        $response = new FileListResponse();
        $response->setState("SUCCESS");
        $response->setList($list);
        $response->setStart($start);
        $response->setTotal(count($files));
        return $response;
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param       $path
     * @param array $files
     * @return array
     */
    function getFiles($path, $allowFiles, &$files = array())
    {
        if (!is_dir($path)) return null;
        if (substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getFiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                        $files[] = array(
                            'url'   => substr($path2, strlen($this->rootPath)),
                            'mtime' => filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }

}
