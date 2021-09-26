<?php

namespace EasySwoole\Oss\Tests\AliYun;

use EasySwoole\Oss\AliYun\Http\Response;
use EasySwoole\Oss\AliYun\Model\ServerSideEncryptionConfig;
use EasySwoole\Oss\AliYun\Result\GetBucketEncryptionResult;
use EasySwoole\Oss\AliYun\Core\OssException;

class GetBucketEncryptionResultTest extends AliYunBaseTestCase
{

    private $validXml = <<<BBBB
        <?xml version="1.0" ?>
        <ServerSideEncryptionRule>
          <ApplyServerSideEncryptionByDefault>
            <SSEAlgorithm>AES256</SSEAlgorithm>
            <KMSMasterKeyID></KMSMasterKeyID>
          </ApplyServerSideEncryptionByDefault>
        </ServerSideEncryptionRule>
        BBBB;

    private $validXml1 = <<<BBBB
        <?xml version="1.0" ?>
        <ServerSideEncryptionRule>
          <ApplyServerSideEncryptionByDefault>
            <SSEAlgorithm>KMS</SSEAlgorithm>
            <KMSMasterKeyID>kms-id</KMSMasterKeyID>
          </ApplyServerSideEncryptionByDefault>
        </ServerSideEncryptionRule>
        BBBB;

    private $validXml2 = <<<BBBB
        <?xml version="1.0" ?>
        <ServerSideEncryptionRule>
          <ApplyServerSideEncryptionByDefault>
            <SSEAlgorithm>KMS</SSEAlgorithm>
          </ApplyServerSideEncryptionByDefault>
        </ServerSideEncryptionRule>
        BBBB;

    private $invalidXml = <<<BBBB
        <?xml version="1.0" ?>
        <ServerSideEncryptionRule>
        </ServerSideEncryptionRule>
        BBBB;

    public function testParseValidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketEncryptionResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $config = $result->getData();
        /**
         * @var $config ServerSideEncryptionConfig
         */
        $this->assertEquals("AES256", $config->getSSEAlgorithm());
        $this->assertEquals("", $config->getKMSMasterKeyID());

        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml1,
            'statusCode'=>200,
        ]);
        $result = new GetBucketEncryptionResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $config = $result->getData();
        $this->assertEquals("KMS", $config->getSSEAlgorithm());
        $this->assertEquals("kms-id", $config->getKMSMasterKeyID());

        $response = new Response([
            'headers'=>[],
            'body'=>$this->validXml2,
            'statusCode'=>200,
        ]);
        $result = new GetBucketEncryptionResult($response);
        $this->assertTrue($result->isOK());
        $this->assertNotNull($result->getData());
        $this->assertNotNull($result->getRawResponse());
        $config = $result->getData();
        $this->assertEquals("KMS", $config->getSSEAlgorithm());
        $this->assertEquals(null, $config->getKMSMasterKeyID());
    }

    public function testParseNullXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>'',
            'statusCode'=>200,
        ]);
        $result = new GetBucketEncryptionResult($response);
        /**
         * @var $config ServerSideEncryptionConfig
         */
        $config = $result->getData();
        $this->assertEquals(null, $config->getSSEAlgorithm());
        $this->assertEquals(null, $config->getKMSMasterKeyID());
    }

    public function testParseInvalidXml()
    {
        $response = new Response([
            'headers'=>[],
            'body'=>$this->invalidXml,
            'statusCode'=>200,
        ]);
        $result = new GetBucketEncryptionResult($response);
        $config = $result->getData();
        $this->assertEquals(null, $config->getSSEAlgorithm());
        $this->assertEquals(null, $config->getKMSMasterKeyID());
    }
}
