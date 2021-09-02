<?php

namespace EasySwoole\Oss;


use EasySwoole\HttpClient\Bean\Response;
use EasySwoole\HttpClient\Exception\InvalidUrl;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\HttpClient\Traits\UriManager;
use Swoole\Coroutine\Http\Client;
use Swoole\WebSocket\Frame;

class BaseOssClient
{
    use UriManager;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $clientSetting = [];

    /**
     * @var array
     */
    protected $cookies = [];


    protected $followLocation = 3;
    protected $redirected = 0;

    function enableFollowLocation(int $maxRedirect = 5): int
    {
        $this->followLocation = $maxRedirect;
        return $this->followLocation;
    }

    /**
     * @var array
     */
    protected $header = [
        "user-agent" => 'EasySwooleHttpClient/0.1',
        'accept' => '*/*',
        'pragma' => 'no-cache',
        'cache-control' => 'no-cache'
    ];

    /**
     * @param string|null $url
     * @throws InvalidUrl
     */
    public function __construct(?string $url = null)
    {
        if (!empty($url)) {
            $this->setUrl($url);
        }
        $this->setTimeout(3);
        $this->setConnectTimeout(5);
    }


    /**
     * @param float $timeout
     * @return BaseOssClient
     */
    public function setTimeout(float $timeout): BaseOssClient
    {
        $this->clientSetting['timeout'] = $timeout;
        return $this;
    }

    /**
     * @param float $connectTimeout
     * @return BaseOssClient
     */
    public function setConnectTimeout(float $connectTimeout): BaseOssClient
    {
        $this->clientSetting['connect_timeout'] = $connectTimeout;
        return $this;
    }

    /**
     * @param bool $keepAlive
     * @return $this
     */
    public function setKeepAlive(bool $keepAlive = true)
    {
        $this->clientSetting['keep_alive'] = $keepAlive;
        return $this;
    }

    /**
     * @param string $sslHostName
     * @return BaseOssClient
     */
    public function setSslHostName(string $sslHostName)
    {
        $this->clientSetting['ssl_host_name'] = $sslHostName;
        return $this;
    }

    /**
     * @param bool $sslVerifyPeer
     * @param bool $sslAllowSelfSigned
     * @return BaseOssClient
     */
    public function setSslVerifyPeer(bool $sslVerifyPeer = true, $sslAllowSelfSigned = false)
    {
        $this->clientSetting['ssl_verify_peer'] = $sslVerifyPeer;
        $this->clientSetting['ssl_allow_self_signed'] = $sslAllowSelfSigned;
        return $this;
    }

    /**
     * @param string $sslCafile
     * @return $this
     */
    public function setSslCafile(string $sslCafile)
    {
        $this->clientSetting['ssl_cafile'] = $sslCafile;
        return $this;
    }

    /**
     * @param string $sslCapath
     * @return $this
     */
    public function setSslCapath(string $sslCapath)
    {
        $this->clientSetting['ssl_capath'] = $sslCapath;
        return $this;
    }

    /**
     * @param string $sslCertFile
     * @return $this
     */
    public function setSslCertFile(string $sslCertFile)
    {
        $this->clientSetting['ssl_cert_file'] = $sslCertFile;
        return $this;
    }

    /**
     * @param string $sslKeyFile
     * @return $this
     */
    public function setSslKeyFile(string $sslKeyFile)
    {
        $this->clientSetting['ssl_key_file'] = $sslKeyFile;
        return $this;
    }

    /**
     * @param string $proxyHost
     * @param int $proxyPort
     * @param string|null $proxyUser
     * @param string|null $proxyPass
     * @return $this
     */
    public function setProxyHttp(string $proxyHost, int $proxyPort, string $proxyUser = null, string $proxyPass = null)
    {
        $this->clientSetting['http_proxy_host'] = $proxyHost;
        $this->clientSetting['http_proxy_port'] = $proxyPort;

        if (!empty($proxyUser)) {
            $this->clientSetting['http_proxy_user'] = $proxyUser;
        }

        if (!empty($proxyPass)) {
            $this->clientSetting['http_proxy_password'] = $proxyPass;
        }

        return $this;
    }

    /**
     * @param string $proxyHost
     * @param int $proxyPort
     * @param string|null $proxyUser
     * @param string|null $proxyPass
     * @return BaseOssClient
     */
    public function setProxySocks5(string $proxyHost, int $proxyPort, string $proxyUser = null, string $proxyPass = null)
    {
        $this->clientSetting['socks5_host'] = $proxyHost;
        $this->clientSetting['socks5_port'] = $proxyPort;

        if (!empty($proxyUser)) {
            $this->clientSetting['socks5_username'] = $proxyUser;
        }

        if (!empty($proxyPass)) {
            $this->clientSetting['socks5_password'] = $proxyPass;
        }

        return $this;
    }

    /**
     * @param string $bindAddress
     * @param integer $bindPort
     * @return BaseOssClient
     */
    public function setSocketBind(string $bindAddress, int $bindPort)
    {
        $this->clientSetting['bind_address'] = $bindAddress;
        $this->clientSetting['bind_port'] = $bindPort;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $setting
     * @return BaseOssClient
     */
    public function setClientSetting(string $key, $setting): BaseOssClient
    {
        $this->clientSetting[$key] = $setting;
        return $this;
    }

    /**
     * @param array $settings
     * @param bool $isMerge
     * @return BaseOssClient
     */
    public function setClientSettings(array $settings, $isMerge = true): BaseOssClient
    {
        if ($isMerge) {  // 合并配置项到当前配置中
            foreach ($settings as $name => $value) {
                $this->clientSetting[$name] = $value;
            }
        } else {
            $this->clientSetting = $settings;
        }
        return $this;
    }

    public function setBasicAuth(string $userName, string $password): BaseOssClient
    {
        $basicAuthToken = base64_encode("{$userName}:{$password}");
        $this->setHeader('Authorization', "Basic {$basicAuthToken}", false);
        return $this;
    }

    public function getClient(): Client
    {
        if ($this->httpClient instanceof Client) {
            $url = $this->parserUrlInfo();
            $this->httpClient->host = $url->getHost();
            $this->httpClient->port = $url->getPort();
            $this->httpClient->ssl = $url->getIsSsl();
            $this->httpClient->set($this->clientSetting);
            return $this->httpClient;
        }
        $url = $this->parserUrlInfo();
        $this->httpClient = new Client($url->getHost(), $url->getPort(), $url->getIsSsl());
        $this->httpClient->set($this->clientSetting);
        return $this->getClient();
    }

    public function setMethod(string $method): BaseOssClient
    {
        $this->getClient()->setMethod($method);
        return $this;
    }

    /**
     * @return $this
     */
    public function setXMLHttpRequest()
    {
        $this->setHeader('x-requested-with', 'xmlhttprequest');
        return $this;
    }

    /**
     * @return $this
     */
    public function setContentTypeJson()
    {
        $this->setContentType(HttpClient::CONTENT_TYPE_APPLICATION_JSON);
        return $this;
    }

    /**
     * @return $this
     */
    public function setContentTypeXml()
    {
        $this->setContentType(HttpClient::CONTENT_TYPE_APPLICATION_XML);
        return $this;
    }

    /**
     * @return $this
     */
    public function setContentTypeFormData()
    {
        $this->setContentType(HttpClient::CONTENT_TYPE_FORM_DATA);
        return $this;
    }

    /**
     * @return $this
     */
    public function setContentTypeFormUrlencoded()
    {
        $this->setContentType(HttpClient::CONTENT_TYPE_X_WWW_FORM_URLENCODED);
        return $this;
    }

    /**
     * @param string $contentType
     * @return BaseOssClient
     */
    public function setContentType(string $contentType)
    {
        $this->setHeader('content-type', $contentType);
        return $this;
    }

    /**
     * @param Client $client
     * @return Response
     */
    private function createHttpResponse(Client $client): Response
    {
        $response = new Response((array)$client);
        $response->setClient($client);
        return $response;
    }


    /**
     * @param string $httpMethod
     * @param null $rawData
     * @param string $contentType
     * @return Response
     * @throws InvalidUrl
     */
    protected function rawRequest($httpMethod = HttpClient::METHOD_GET, $rawData = null, $contentType = null): Response
    {
        $client = $this->getClient();
        //预处理。合并cookie 和header
        $this->setMethod($httpMethod);
        $client->setCookies((array)$this->cookies + (array)$client->cookies);
        if ($httpMethod == HttpClient::METHOD_POST) {
            if (is_array($rawData)) {
                foreach ($rawData as $key => $item) {
                    if ($item instanceof \CURLFile) {
                        $client->addFile($item->getFilename(), $key, $item->getMimeType(), $item->getPostFilename());
                        unset($rawData[$key]);
                    }
                }
                $client->setData($rawData);
            } else if ($rawData !== null) {
                $client->setData($rawData);
            }
        } else if ($rawData !== null) {
            $client->setData($rawData);
        }
        if (is_string($rawData)) {
            $this->setHeader('Content-Length', strlen($rawData));
        }
        if (!empty($contentType)) {
            $this->setContentType($contentType);
        }
        $client->setHeaders($this->header);
        $client->execute($this->url->getFullPath());
        // 如果不设置保持长连接则直接关闭当前链接
        if (!isset($this->clientSetting['keep_alive']) || $this->clientSetting['keep_alive'] !== true) {
            $client->close();
        }
        // 处理重定向
        if (($client->statusCode == 301 || $client->statusCode == 302) && (($this->followLocation > 0) && ($this->redirected < $this->followLocation))) {
            $this->redirected++;
            $location = $client->headers['location'];
            $info = parse_url($location);
            // scheme 为空 没有域名
            if (empty($info['scheme']) && empty($info['host'])) {
                $this->url->setPath($location);
                $this->parserUrlInfo();
            } else {
                // 去除//开头的跳转域名
                $location = ltrim($location, '//');
                $this->setUrl($location);
                $this->httpClient = null;
            }
            return $this->rawRequest($httpMethod, $rawData, $contentType);
        } else {
            $this->redirected = 0;
        }
        return $this->createHttpResponse($client);
    }

    /**
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function get(array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_GET);
    }

    /**
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function head(array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_HEAD);

    }

    /**
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function trace(array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_TRACE);

    }

    /**
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function delete(array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_DELETE);

    }


    /**
     * @param null $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function put($data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_PUT, $data);
    }

    /**
     * @param null $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function post($data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_POST, $data);
    }

    /**
     * @param null $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function patch($data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_PATCH, $data);
    }

    /**
     * @param null $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function options($data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_OPTIONS, $data);
    }


    /**
     * @param string $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function postXml(string $data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_POST, $data, HttpClient::CONTENT_TYPE_APPLICATION_XML);
    }

    /**
     * @param string $data
     * @param array $headers
     * @return Response
     * @throws InvalidUrl
     */
    public function postJson(string $data = null, array $headers = []): Response
    {
        return $this->setHeaders($headers)->rawRequest(HttpClient::METHOD_POST, $data, HttpClient::CONTENT_TYPE_APPLICATION_JSON);
    }

    /**
     * @param string $filename
     * @param int $offset
     * @param string $httpMethod
     * @param null $rawData
     * @param null $contentType
     * @return Response|false
     * @throws InvalidUrl
     */
    public function download(string $filename, int $offset = 0, $httpMethod = HttpClient::METHOD_GET, $rawData = null, $contentType = null)
    {
        $client = $this->getClient();
        $client->setMethod($httpMethod);

        // 如果提供了数组那么认为是x-www-form-unlencoded快捷请求
        if (is_array($rawData)) {
            $rawData = http_build_query($rawData);
            $this->setContentTypeFormUrlencoded();
        }

        // 直接设置请求包体 (特殊格式的包体可以使用提供的Helper来手动构建)
        if (!empty($rawData)) {
            $client->setData($rawData);
            $this->setHeader('Content-Length', strlen($rawData));
        }

        // 设置ContentType(如果未设置默认为空的)
        if (!empty($contentType)) {
            $this->setContentType($contentType);
        }

        $response = $client->download($this->url->getFullPath(), $filename, $offset);
        return $response ? $this->createHttpResponse($client) : false;
    }


    /**
     * @param array $header
     * @param bool $isMerge
     * @param bool $strtolower
     * @return BaseOssClient
     */
    public function setHeaders(array $header, $isMerge = true, $strtolower = true): BaseOssClient
    {
        if (empty($header)) {
            return $this;
        }

        // 非合并模式先清空当前的Header再设置
        if (!$isMerge) {
            $this->header = [];
        }

        foreach ($header as $name => $value) {
            $this->setHeader($name, $value, $strtolower);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @param bool $strtolower
     * @return BaseOssClient
     */
    public function setHeader(string $key, string $value, $strtolower = true): BaseOssClient
    {
        if ($strtolower) {
            $this->header[strtolower($key)] = strtolower($value);
        } else {
            $this->header[$key] = $value;
        }
        return $this;
    }


    /**
     * @param array $cookies
     * @param bool $isMerge
     * @return BaseOssClient
     */
    public function addCookies(array $cookies, $isMerge = true): BaseOssClient
    {
        if ($isMerge) {  // 合并配置项到当前配置中
            foreach ($cookies as $name => $value) {
                $this->cookies[$name] = $value;
            }
        } else {
            $this->cookies = $cookies;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return BaseOssClient
     */
    public function addCookie(string $key, string $value): BaseOssClient
    {
        $this->cookies[$key] = $value;
        return $this;
    }

    function __destruct()
    {
        if ($this->httpClient instanceof Client) {
            if ($this->httpClient->connected) {
                $this->httpClient->close();
            }
            $this->httpClient = null;
        }
    }
}
