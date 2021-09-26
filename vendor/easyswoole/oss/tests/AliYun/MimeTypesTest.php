<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Core\MimeTypes;

class MimeTypesTest extends AliYunBaseTestCase
{
    public function testGetMimeType()
    {
        $this->assertEquals('application/xml', MimeTypes::getMimetype('file.xml'));
    }
}
