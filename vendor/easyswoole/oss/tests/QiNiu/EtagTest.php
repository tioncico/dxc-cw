<?php
namespace EasySwoole\Oss\Tests\QiNiu;

use EasySwoole\Oss\QiNiu\Etag;

class EtagTest extends QiNiuBaseTestCase
{
    public function test0M()
    {
        $file = $this->qiniuTempFile(0);
        list($r, $error) = Etag::sum($file);
        unlink($file);
        $this->assertEquals('Fto5o-5ea0sNMlW_75VgGJCv2AcJ', $r);
        $this->assertNull($error);
    }

    public function testLess4M()
    {
        $file = $this->qiniuTempFile(3 * 1024 * 1024);
        list($r, $error) = Etag::sum($file);
        unlink($file);
        $this->assertEquals('Fs5BpnAjRykYTg6o5E09cjuXrDkG', $r);
        $this->assertNull($error);
    }

    public function test4M()
    {
        $file = $this->qiniuTempFile(4 * 1024 * 1024);
        list($r, $error) = Etag::sum($file);
        unlink($file);
        $this->assertEquals('FiuKULnybewpEnrfTmxjsxc-3dWp', $r);
        $this->assertNull($error);
    }

    public function testMore4M()
    {
        $file = $this->qiniuTempFile(5 * 1024 * 1024);
        list($r, $error) = Etag::sum($file);
        unlink($file);
        $this->assertEquals('lhvyfIWMYFTq4s4alzlhXoAkqfVL', $r);
        $this->assertNull($error);
    }

    public function test8M()
    {
        $file = $this->qiniuTempFile(8 * 1024 * 1024);
        list($r, $error) = Etag::sum($file);
        unlink($file);
        $this->assertEquals('lmRm9ZfGZ86bnMys4wRTWtJj9ClG', $r);
        $this->assertNull($error);
    }
}
