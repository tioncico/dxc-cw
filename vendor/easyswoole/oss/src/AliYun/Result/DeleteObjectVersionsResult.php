<?php

namespace EasySwoole\Oss\AliYun\Result;

use EasySwoole\Oss\AliYun\Core\OssUtil;
use EasySwoole\Oss\AliYun\Model\DeletedObjectInfo;

/**
 * Class DeleteObjectVersionsResult
 * @package EasySwoole\Oss\AliYun\Result
 */
class DeleteObjectVersionsResult extends Result
{
    /**
     * @return DeletedObjectInfo[]
     */
    protected function parseDataFromResponse()
    {
        $xml = simplexml_load_string($this->rawResponse->getBody());
        $encodingType = isset($xml->EncodingType) ? strval($xml->EncodingType) : "";
        return $this->parseDeletedList($xml, $encodingType);
    }

    private function parseDeletedList($xml, $encodingType)
    {
        $retList = array();
        if (isset($xml->Deleted)) {
            foreach ($xml->Deleted as $content) {
                $key = isset($content->Key) ? strval($content->Key) : "";
                $key = OssUtil::decodeKey($key, $encodingType);
                $versionId = isset($content->VersionId) ? strval($content->VersionId) : "";
                $deleteMarker = isset($content->DeleteMarker) ? strval($content->DeleteMarker) : "";
                $deleteMarkerVersionId = isset($content->DeleteMarkerVersionId) ? strval($content->DeleteMarkerVersionId) : "";
                $retList[] = new DeletedObjectInfo($key, $versionId, $deleteMarker, $deleteMarkerVersionId);
            }
        }
        return $retList;
    }
}
