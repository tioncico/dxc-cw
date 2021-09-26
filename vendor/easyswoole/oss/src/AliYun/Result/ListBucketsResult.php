<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Model\BucketInfo;
use EasySwoole\Oss\AliYun\Model\BucketListInfo;

/**
 * Class ListBucketsResult
 *
 * @package EasySwoole\Oss\AliYun\Result
 */
class ListBucketsResult extends Result
{
    /**
     * @return BucketListInfo
     */
    protected function parseDataFromResponse()
    {
        $bucketList = array();
        $content = $this->rawResponse->getBody();
        $xml = new \SimpleXMLElement($content);
        if (isset($xml->Buckets) && isset($xml->Buckets->Bucket)) {
            foreach ($xml->Buckets->Bucket as $bucket) {
                $bucketInfo = new BucketInfo();
                $bucketInfo->parseFromXmlNode($bucket);
                $bucketList[] = $bucketInfo;
            }
        }
        return new BucketListInfo($bucketList);
    }
}
