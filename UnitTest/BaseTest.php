<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/6/12
 * Time: 10:33
 */

namespace UnitTest;


use EasySwoole\EasySwoole\Core;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public static $isInit = 0;
    protected $apiHost = 'http://127.0.0.1:9501';
    protected $apiBase;
    protected $modelName;

    function getApiUrl($action, ?string $modelName = null)
    {
        return "{$this->apiHost}{$this->apiBase}/" . ($modelName ?? $this->modelName)."/{$action}";
    }

    protected function request($action, $data = [], $modelName = null)
    {
        $url = $this->getApiUrl($action, $modelName);
        var_dump($url);
        $curl = $this->curl;
        $curl->post($url, $data);
        $this->assertTrue(!!$curl->response, $curl->errorMessage);
        $this->assertEquals(200, $curl->response->code, $curl->response->msg ?? json_encode($curl->response));
        return $curl->response;
    }

    protected function requestError($action, $data = [])
    {
        $url = $this->apiBase . '/' . $this->modelName . '/' . $action;
        $curl = $this->curl;
        $curl->post($url, $data);
        $this->assertTrue(!!$curl->response, "请求失败!");
        $this->assertNotEquals(200, $curl->response->code, $curl->response->msg);
        return $curl->response;
    }
    /**
     * 准备测试基境
     * @return void
     */
    function setUp(): void
    {
        if (self::$isInit == 0) {
            require_once dirname(__FILE__, 2) . '/vendor/autoload.php';
            defined('EASYSWOOLE_ROOT') or define('EASYSWOOLE_ROOT', dirname(__FILE__, 2));
            defined('TEST') or define('TEST', 1);
            require_once dirname(__FILE__, 2) . '/EasySwooleEvent.php';
            Core::getInstance()->initialize();
            self::$isInit = 1;
        }
    }

    function print($response)
    {
        var_dump($response);
        var_dump(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
