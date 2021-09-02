<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */

namespace EasySwoole\UEditor\Test;

use EasySwoole\UEditor\Config\CatcherConfig;
use EasySwoole\UEditor\UEditor;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testGetConfig()
    {
        $UEditor = new UEditor('./Upload');
        $config = $UEditor->getConfig();
        $this->assertEmpty($config['catcherUrlPrefix']);

        $catcherConfig = new CatcherConfig();
        $catcherConfig->setCatcherUrlPrefix('http://xxx.xxx.xxx/');
        $UEditor->setConfigList([$catcherConfig]);
        $config = $UEditor->getConfig();
        $this->assertEquals('http://xxx.xxx.xxx/', $config['catcherUrlPrefix']);
    }
}
