<?php

namespace EasySwoole\Oss\Tencent;

use EasySwoole\Oss\Tencent\Http\HttpClient;

class Signature {
    private $accessKey;           // string: access key.
    private $secretKey;           // string: secret key.
    public function __construct($accessKey, $secretKey) {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        date_default_timezone_set("PRC");
    }
    public function __destruct() {
    }
    public function signRequest(HttpClient $request) {
        $authorization = $this->createAuthorization($request);
        return $request->setHeader('Authorization', $authorization,false);
    }
    public function createAuthorization(HttpClient $request, $expires = "+30 minutes") {

        $signTime = (string)(time() - 60) . ';' . (string)(strtotime($expires));

        $httpString = strtolower($request->getClient()->requestMethod) . "\n" .
            urldecode($request->getUrl()->getPath()) .
            "\n\nhost=" . $request->getUrl()->getHost() . "\n";
        $sha1edHttpString = sha1($httpString);
        $stringToSign = "sha1\n$signTime\n$sha1edHttpString\n";
        $signKey = hash_hmac('sha1', $signTime, $this->secretKey);
        $signature = hash_hmac('sha1', $stringToSign, $signKey);
        $authorization = 'q-sign-algorithm=sha1&q-ak='. $this->accessKey .
            "&q-sign-time=$signTime&q-key-time=$signTime&q-header-list=host&q-url-param-list=&" .
            "q-signature=$signature";

        return $authorization;
    }

    public function createPresignedUrl(HttpClient $request, $expires = "+30 minutes") {
        $authorization = $this->createAuthorization($request, $expires);
        $uri = $request->getUrl();
        $uri->setQuery(OssUtil::filterQueryAndFragment("sign=".urlencode($authorization)));
        return $uri;
    }
}
