<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Result\GetBucketRequestPaymentResult;
use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Http\Response;

class GetBucketRequestPaymentResultTest extends AliYunBaseTestCase
{

    private $validXml = <<<BBBB
        <?xml version="1.0" ?>
        <RequestPaymentConfiguration>
          <Payer>Requester</Payer>
        </RequestPaymentConfiguration>
        BBBB;

    private $validXml2 = <<<BBBB
        <?xml version="1.0" ?>
        <RequestPaymentConfiguration>
          <Payer>BucketOwner</Payer>
        </RequestPaymentConfiguration>
        BBBB;

    private $invalidXml = <<<BBBB
        <?xml version="1.0" ?>
        <RequestPaymentConfiguration>
        </RequestPaymentConfiguration>
        BBBB;

    public function testParseValidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketRequestPaymentResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $payer = $result->getData();
        $this->assertEquals("Requester", $payer);

        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml2,
            'statusCode'=>200,
        ]);
        $result = new GetBucketRequestPaymentResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $payer = $result->getData();
        $this->assertEquals("BucketOwner", $payer);
    }

    public function testParseNullXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>"",
            'statusCode'=>200,
        ]);
        $result = new GetBucketRequestPaymentResult($response);
        $payer = $result->getData();
        $this->assertEquals(null, $payer);
    }

    public function testParseInvalidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->invalidXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketRequestPaymentResult($response);
        $payer = $result->getData();
        $this->assertEquals(null, $payer);
    }
}
