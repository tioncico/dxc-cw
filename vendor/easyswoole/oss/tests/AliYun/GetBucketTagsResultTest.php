<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Result\GetBucketTagsResult;
use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\Response;

class GetBucketTagsResultTest extends AliYunBaseTestCase
{
    private $validXml = <<<BBBB
        <?xml version="1.0" ?>
        <Tagging>
          <TagSet>
            <Tag>
              <Key>testa</Key>
              <Value>value1-test</Value>
            </Tag>
            <Tag>
              <Key>testb</Key>
              <Value>value2-test</Value>
            </Tag>
          </TagSet>
        </Tagging>
        BBBB;

    private $invalidXml = <<<BBBB
        <?xml version="1.0" ?>
        <Tagging>
        </Tagging>
        BBBB;

    private $invalidXml2 = <<<BBBB
        <?xml version="1.0" ?>
        <Tagging>
          <TagSet>
          </TagSet>
        </Tagging>
        BBBB;

    public function testParseValidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketTagsResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $config = $result->getData();
        $this->assertEquals(2, count($config->getTags()));
        $this->assertEquals("testa", $config->getTags()[0]->getKey());
        $this->assertEquals("value1-test", $config->getTags()[0]->getValue());
        $this->assertEquals("testb", $config->getTags()[1]->getKey());
        $this->assertEquals("value2-test", $config->getTags()[1]->getValue());
    }

    public function testParseNullXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>"",
            'statusCode'=>200,
        ]);
        $result = new GetBucketTagsResult($response);
        $config = $result->getData();
        $this->assertEquals(0, count($config->getTags()));

    }

    public function testParseInvalidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->invalidXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketTagsResult($response);
        $config = $result->getData();
        $this->assertEquals(0, count($config->getTags()));

        $response = new Response([
            'headers'=>[],
            'body'=>$this->invalidXml2,
            'statusCode'=>200,
        ]);
        $result = new GetBucketTagsResult($response);
        $config = $result->getData();
        $this->assertEquals(0, count($config->getTags()));
    }
}
