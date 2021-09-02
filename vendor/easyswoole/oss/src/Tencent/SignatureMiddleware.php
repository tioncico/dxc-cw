<?php

namespace EasySwoole\Oss\Tencent;

use EasySwoole\Oss\Tencent\Exception\ServiceResponseException;
use EasySwoole\Oss\Tencent\Exception\NoSuchKeyException;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SignatureMiddleware {
    private $nextHandler;
    protected $signature;

    /**
     * @param callable $nextHandler Next handler to invoke.
     */
    public function __construct(callable $nextHandler, $accessKey, $secretKey) {
        $this->nextHandler = $nextHandler;
        $this->signature = new Signature($accessKey, $secretKey);
    }

    public function __invoke(RequestInterface $request, array $options) {
        $fn = $this->nextHandler;
        return $fn($this->signature->signRequest($request), $options);
	}
}
