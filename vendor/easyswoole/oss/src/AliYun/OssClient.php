<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/11/14 0014
 * Time: 15:03
 */

namespace EasySwoole\Oss\AliYun;


use EasySwoole\Oss\AliYun\Core\MimeTypes;
use EasySwoole\Oss\AliYun\Core\OssException;
use EasySwoole\Oss\AliYun\Core\OssUtil;
use EasySwoole\Oss\AliYun\Http\HttpClient;
use EasySwoole\Oss\AliYun\Http\Response;
use EasySwoole\Oss\AliYun\Http\RequestHeaders;
use EasySwoole\Oss\AliYun\Model\BucketListInfo;
use EasySwoole\Oss\AliYun\Model\CnameConfig;
use EasySwoole\Oss\AliYun\Model\CorsConfig;
use EasySwoole\Oss\AliYun\Model\ExtendWormConfig;
use EasySwoole\Oss\AliYun\Model\InitiateWormConfig;
use EasySwoole\Oss\AliYun\Model\LoggingConfig;
use EasySwoole\Oss\AliYun\Model\RequestPaymentConfig;
use EasySwoole\Oss\AliYun\Model\StorageCapacityConfig;
use EasySwoole\Oss\AliYun\Model\TaggingConfig;
use EasySwoole\Oss\AliYun\Model\VersioningConfig;
use EasySwoole\Oss\AliYun\Model\WebsiteConfig;
use EasySwoole\Oss\AliYun\Result\DeleteObjectVersionsResult;
use EasySwoole\Oss\AliYun\Result\ExistResult;
use EasySwoole\Oss\AliYun\Result\GetBucketEncryptionResult;
use EasySwoole\Oss\AliYun\Result\GetBucketInfoResult;
use EasySwoole\Oss\AliYun\Result\GetBucketRequestPaymentResult;
use EasySwoole\Oss\AliYun\Result\GetBucketStatResult;
use EasySwoole\Oss\AliYun\Result\GetBucketTagsResult;
use EasySwoole\Oss\AliYun\Result\GetBucketVersioningResult;
use EasySwoole\Oss\AliYun\Result\GetBucketWormResult;
use EasySwoole\Oss\AliYun\Result\GetLocationResult;
use EasySwoole\Oss\AliYun\Result\InitiateBucketWormResult;
use EasySwoole\Oss\AliYun\Result\ListBucketsResult;
use EasySwoole\Oss\AliYun\Result\ListObjectVersionsResult;
use EasySwoole\Oss\AliYun\Result\PutSetDeleteResult;
use EasySwoole\HttpClient\Exception\InvalidUrl;
use EasySwoole\Oss\AliYun\Result\AclResult;
use EasySwoole\Oss\AliYun\Result\BodyResult;
use EasySwoole\Oss\AliYun\Result\GetCorsResult;
use EasySwoole\Oss\AliYun\Result\GetLifecycleResult;
use EasySwoole\Oss\AliYun\Result\GetLoggingResult;
use EasySwoole\Oss\AliYun\Result\GetRefererResult;
use EasySwoole\Oss\AliYun\Result\GetWebsiteResult;
use EasySwoole\Oss\AliYun\Result\GetCnameResult;
use EasySwoole\Oss\AliYun\Result\HeaderResult;
use EasySwoole\Oss\AliYun\Result\InitiateMultipartUploadResult;
use EasySwoole\Oss\AliYun\Result\ListMultipartUploadResult;
use EasySwoole\Oss\AliYun\Result\SymlinkResult;
use EasySwoole\Oss\AliYun\Result\TaggingResult;
use EasySwoole\Oss\AliYun\Result\UploadPartResult;
use EasySwoole\Oss\AliYun\Result\ListObjectsResult;
use EasySwoole\Oss\AliYun\Result\ListPartsResult;
use EasySwoole\Oss\AliYun\Result\DeleteObjectsResult;
use EasySwoole\Oss\AliYun\Result\CopyObjectResult;
use EasySwoole\Oss\AliYun\Result\CallbackResult;
use EasySwoole\Oss\AliYun\Result\PutLiveChannelResult;
use EasySwoole\Oss\AliYun\Result\GetLiveChannelHistoryResult;
use EasySwoole\Oss\AliYun\Result\GetLiveChannelInfoResult;
use EasySwoole\Oss\AliYun\Result\GetLiveChannelStatusResult;
use EasySwoole\Oss\AliYun\Result\ListLiveChannelResult;
use EasySwoole\Oss\AliYun\Result\GetStorageCapacityResult;
use EasySwoole\Oss\AliYun\Result\AppendResult;
use EasySwoole\Spl\SplFileStream;
use Swoole\Coroutine;

class OssClient
{
    /**
     * @var $config Config
     */
    protected $config;

    protected $requestUrl;

    protected $hostname;


    // 用户提供的域名类型，有四种 OSS_HOST_TYPE_NORMAL, OSS_HOST_TYPE_IP, OSS_HOST_TYPE_SPECIAL, OSS_HOST_TYPE_CNAME
    protected $hostType = OssConst::OSS_HOST_TYPE_NORMAL;

    protected $enableStsInUrl = false;

    protected $securityToken = null;
    //超时时间
    protected $timeout = 0;
    //连接超时时间
    protected $connectTimeout = 0;

    //是否使用ssl
    private $useSSL = false;
    //最大重试次数
    private $maxRetries = 3;
    //是否开启代理
    protected $requestProxy = null;// $requestProxy=['127.0.0.1','8080','user','pass']

    public function __construct(Config $config, $securityToken = NULL, $requestProxy = null)
    {
        $this->config = $config;
        $this->requestProxy = $requestProxy;
        $this->securityToken = $securityToken;
        $this->hostname = $this->checkEndpoint();
    }

    ##############################请求方法######################################

    ###########################buket请求#################################
    /**
     * listBuckets
     * @param array $options
     * @return mixed
     * @throws OssException
     * @throws InvalidUrl
     * @author Tioncico
     * Time: 15:30
     */
    public function listBuckets(array $options = []): BucketListInfo
    {
        if ($this->hostType === OssConst::OSS_HOST_TYPE_CNAME) {
            throw new OssException("operation is not permitted with CName host");
        }
        OssUtil::validateOptions($options);
        $options[OssConst::OSS_BUCKET] = '';
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $response = $this->auth($options);
        $result = new ListBucketsResult($response);
        return $result->getData();
    }

    /**
     * 创建bucket，默认创建的bucket的ACL是OssClient::OSS_ACL_TYPE_PRIVATE
     *
     * @param string $bucket
     * @param string $acl
     * @param array  $options
     * @param string $storageType
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function createBucket($bucket, $acl = OssConst::OSS_ACL_TYPE_PRIVATE, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_HEADERS] = array(OssConst::OSS_ACL => $acl);
        if (isset($options[OssConst::OSS_STORAGE])) {
            $this->preCheckStorage($options[OssConst::OSS_STORAGE]);
            $options[OssConst::OSS_CONTENT] = OssUtil::createBucketXmlBody($options[OssConst::OSS_STORAGE]);
            unset($options[OssConst::OSS_STORAGE]);
        }
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 删除bucket
     * 如果Bucket不为空（Bucket中有Object，或者有分块上传的碎片），则Bucket无法删除，
     * 必须删除Bucket中的所有Object以及碎片后，Bucket才能成功删除。
     *
     * @param string $bucket
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucket($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 判断bucket是否存在
     *
     * @param string $bucket
     * @return bool
     * @throws InvalidUrl
     * @throws OssException
     */
    public function doesBucketExist($bucket)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'acl';
        $response = $this->auth($options);
        $result = new ExistResult($response);

        return $result->getData();
    }

    /**
     * 获取bucket所属的数据中心位置信息
     *
     * @param string $bucket
     * @param array  $options
     * @return string
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketLocation($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'location';
        $response = $this->auth($options);
        $result = new GetLocationResult($response);
        return $result->getData();
    }

    /**
     * 获取Bucket的Meta信息
     *
     * @param string $bucket
     * @param array  $options 具体参考SDK文档
     * @return array
     * @throws InvalidUrl
     * @throws OssException
     */
    public function getBucketMeta($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_HEAD;
        $options[OssConst::OSS_OBJECT] = '/';
        $response = $this->auth($options);
        $result = new HeaderResult($response);

        return $result->getData();
    }

    /**
     * 获取bucket的ACL配置情况
     *
     * @param string $bucket
     * @param array  $options
     * @return string
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketAcl($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'acl';
        $response = $this->auth($options);
        $result = new AclResult($response);
        return $result->getData();
    }

    /**
     * 设置bucket的ACL配置情况
     *
     * @param string $bucket bucket名称
     * @param string $acl 读写权限，可选值 ['private', 'public-read', 'public-read-write']
     * @param array  $options 可以为空
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketAcl($bucket, $acl, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_HEADERS] = array(OssConst::OSS_ACL => $acl);
        $options[OssConst::OSS_SUB_RESOURCE] = 'acl';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取Bucket的访问日志配置情况
     *
     * @param string $bucket bucket名称
     * @param array  $options 可以为空
     * @return LoggingConfig
     * @throws InvalidUrl
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketLogging($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'logging';
        $response = $this->auth($options);
        $result = new GetLoggingResult($response);
        return $result->getData();
    }

    /**
     * 开启Bucket访问日志记录功能，只有Bucket的所有者才能更改
     *
     * @param string $bucket bucket名称
     * @param string $targetBucket 日志文件存放的bucket
     * @param string $targetPrefix 日志的文件前缀
     * @param array  $options 可以为空
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketLogging($bucket, $targetBucket, $targetPrefix, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $this->preCheckBucket($targetBucket, 'targetbucket is not allowed empty');
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'logging';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';

        $loggingConfig = new LoggingConfig($targetBucket, $targetPrefix);
        $options[OssConst::OSS_CONTENT] = $loggingConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 关闭bucket访问日志记录功能
     *
     * @param string $bucket bucket名称
     * @param array  $options 可以为空
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketLogging($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'logging';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 将bucket设置成静态网站托管模式
     *
     * @param string        $bucket bucket名称
     * @param WebsiteConfig $websiteConfig
     * @param array         $options 可以为空
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketWebsite($bucket, $websiteConfig, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'website';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $websiteConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取bucket的静态网站托管状态
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return WebsiteConfig
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketWebsite($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'website';
        $response = $this->auth($options);
        $result = new GetWebsiteResult($response);
        return $result->getData();
    }

    /**
     * 关闭bucket的静态网站托管模式
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketWebsite($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'website';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 在指定的bucket上设定一个跨域资源共享(CORS)的规则，如果原规则存在则覆盖原规则
     *
     * @param string     $bucket bucket名称
     * @param CorsConfig $corsConfig 跨域资源共享配置，具体规则参见SDK文档
     * @param array      $options array
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketCors($bucket, $corsConfig, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cors';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $corsConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取Bucket的CORS配置情况
     *
     * @param string $bucket bucket名称
     * @param array  $options 可以为空
     * @return CorsConfig
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketCors($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cors';
        $response = $this->auth($options);
        $result = new GetCorsResult($response, __FUNCTION__);
        return $result->getData();
    }

    /**
     * 关闭指定Bucket对应的CORS功能并清空所有规则
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketCors($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cors';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 为指定Bucket增加CNAME绑定
     *
     * @param string $bucket bucket名称
     * @param string $cname
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function addBucketCname($bucket, $cname, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cname';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $cnameConfig = new CnameConfig();
        $cnameConfig->addCname($cname);
        $options[OssConst::OSS_CONTENT] = $cnameConfig->serializeToXml();
        $options[OssConst::OSS_COMP] = 'add';

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取指定Bucket已绑定的CNAME列表
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return CnameConfig
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketCname($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cname';
        $response = $this->auth($options);
        $result = new GetCnameResult($response);
        return $result->getData();
    }

    /**
     * 解除指定Bucket的CNAME绑定
     *
     * @param string      $bucket bucket名称
     * @param CnameConfig $cnameConfig
     * @param array       $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketCname($bucket, $cname, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'cname';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $cnameConfig = new CnameConfig();
        $cnameConfig->addCname($cname);
        $options[OssConst::OSS_CONTENT] = $cnameConfig->serializeToXml();
        $options[OssConst::OSS_COMP] = 'delete';

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }


    /**
     * Sets the bucket's tags
     *
     * @param string $bucket bucket name
     * @param TaggingConfig $taggingConfig
     * @param array $options
     * @throws OssException
     * @return null
     */
    public function putBucketTags($bucket, $taggingConfig, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $taggingConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Gets bucket's tags
     *
     * @param string $bucket bucket name
     * @param array $options
     * @throws OssException
     * @return TaggingConfig
     */
    public function getBucketTags($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        $response = $this->auth($options);
        $result = new GetBucketTagsResult($response);
        return $result->getData();
    }

    /**
     * Deletes the bucket's tags
     * If want to delete specified tags for a bucket, please set the $tags
     *
     * @param string $bucket bucket name
     * @param tag[] $tags (optional)
     * @param array $options
     * @throws OssException
     * @return null
     */
    public function deleteBucketTags($bucket, $tags = NULL, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        if (empty($tags)) {
            $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        } else {
            $value = '';
            foreach ($tags as $tag ) {
                $value .= $tag->getKey().',';
            }
            $value = rtrim($value, ',');
            $options[OssConst::OSS_TAGGING] = $value;
        }
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    ###########################buket请求#################################

    ###########################object请求#################################
    /**
     * 获取object的ACL属性
     *
     * @param string $bucket
     * @param string $object
     * @return string
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getObjectAcl($bucket, $object)
    {
        $options = array();
        $this->preCheckCommon($bucket, $object, $options, true);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = 'acl';
        $response = $this->auth($options);
        $result = new AclResult($response);
        return $result->getData();
    }

    /**
     * 设置object的ACL属性
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $acl 读写权限，可选值 ['default', 'private', 'public-read', 'public-read-write']
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putObjectAcl($bucket, $object, $acl)
    {
        $this->preCheckCommon($bucket, $object, $options, true);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_HEADERS] = array(OssConst::OSS_OBJECT_ACL => $acl);
        $options[OssConst::OSS_SUB_RESOURCE] = 'acl';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Sets the object tagging
     *
     * @param string $bucket bucket name
     * @param string $object object name
     * @param TaggingConfig $taggingConfig
     * @throws OssException
     * @return null
     */
    public function putObjectTagging($bucket, $object, $taggingConfig, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options, true);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $taggingConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Gets the object tagging
     *
     * @param string $bucket
     * @param string $object
     * @throws OssException
     * @return TaggingConfig
     */
    public function getObjectTagging($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options, true);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        $response = $this->auth($options);
        $result = new GetBucketTagsResult($response);
        return $result->getData();
    }

    /**
     * Deletes the object tagging
     *
     * @param string $bucket
     * @param string $object
     * @throws OssException
     * @return TaggingConfig
     */
    public function deleteObjectTagging($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options, true);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_TAGGING;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Processes the object
     *
     * @param string $bucket bucket name
     * @param string $object object name
     * @param string $process process script
     * @return string process result, json format
     */
    public function processObject($bucket, $object, $process, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = 'x-oss-process';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/octet-stream';
        $options[OssConst::OSS_CONTENT] = 'x-oss-process='.$process;
        $response = $this->auth($options);
        $result = new BodyResult($response);
        return $result->getData();
    }
    ###########################object请求#################################


    /**
     * 为指定Bucket创建LiveChannel
     *
     * @param string            $bucket bucket名称
     * @param string channelName  $channelName
     * @param LiveChannelConfig $channelConfig
     * @param array             $options
     * @return LiveChannelInfo
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketLiveChannel($bucket, $channelName, $channelConfig, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $channelConfig->serializeToXml();

        $response = $this->auth($options);
        $result = new PutLiveChannelResult($response);
        $info = $result->getData();
        $info->setName($channelName);
        $info->setDescription($channelConfig->getDescription());

        return $info;
    }

    /**
     * 设置LiveChannel的status
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param string channelStatus $channelStatus 为enabled或disabled
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putLiveChannelStatus($bucket, $channelName, $channelStatus, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';
        $options[OssConst::OSS_LIVE_CHANNEL_STATUS] = $channelStatus;

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取LiveChannel信息
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param array  $options
     * @return GetLiveChannelInfo
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getLiveChannelInfo($bucket, $channelName, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';

        $response = $this->auth($options);
        $result = new GetLiveChannelInfoResult($response);
        return $result->getData();
    }

    /**
     * 获取LiveChannel状态信息
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param array  $options
     * @return GetLiveChannelStatus
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getLiveChannelStatus($bucket, $channelName, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';
        $options[OssConst::OSS_COMP] = 'stat';

        $response = $this->auth($options);
        $result = new GetLiveChannelStatusResult($response);
        return $result->getData();
    }

    /**
     *获取LiveChannel推流记录
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param array  $options
     * @return GetLiveChannelHistory
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getLiveChannelHistory($bucket, $channelName, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';
        $options[OssConst::OSS_COMP] = 'history';

        $response = $this->auth($options);
        $result = new GetLiveChannelHistoryResult($response);
        return $result->getData();
    }

    /**
     *获取指定Bucket下的live channel列表
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return LiveChannelListInfo
     * @throws OssException
     * @throws InvalidUrl
     */
    public function listBucketLiveChannels($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';
        $options[OssConst::OSS_QUERY_STRING] = array(
            'prefix'   => isset($options['prefix']) ? $options['prefix'] : '',
            'marker'   => isset($options['marker']) ? $options['marker'] : '',
            'max-keys' => isset($options['max-keys']) ? $options['max-keys'] : '',
        );
        $response = $this->auth($options);
        $result = new ListLiveChannelResult($response);
        $list = $result->getData();
        $list->setBucketName($bucket);

        return $list;
    }

    /**
     * 为指定LiveChannel生成播放列表
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param string $playlistName 指定生成的点播播放列表的名称，必须以“.m3u8”结尾
     * @param array  $setTime startTime和EndTime以unix时间戳格式给定,跨度不能超过一天
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function postVodPlaylist($bucket, $channelName, $playlistName, $setTime)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = $channelName . '/' . $playlistName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'vod';
        $options[OssConst::OSS_LIVE_CHANNEL_END_TIME] = $setTime['EndTime'];
        $options[OssConst::OSS_LIVE_CHANNEL_START_TIME] = $setTime['StartTime'];

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 删除指定Bucket的LiveChannel
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketLiveChannel($bucket, $channelName, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = $channelName;
        $options[OssConst::OSS_SUB_RESOURCE] = 'live';

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 生成带签名的推流地址
     *
     * @param string $bucket bucket名称
     * @param string channelName $channelName
     * @param int timeout 设置超时时间，单位为秒
     * @param array  $options
     * @return 推流地址
     * @throws OssException
     * @throws InvalidUrl
     */
    public function signRtmpUrl($bucket, $channelName, $timeout = 60, $options = NULL)
    {
        $this->preCheckCommon($bucket, $channelName, $options, false);
        $expires = time() + $timeout;
        $proto = 'rtmp://';
        $hostname = $this->generateHostname($bucket);
        $cano_params = '';
        $query_items = array();
        $params = isset($options['params']) ? $options['params'] : array();
        uksort($params, 'strnatcasecmp');
        foreach ($params as $key => $value) {
            $cano_params = $cano_params . $key . ':' . $value . "\n";
            $query_items[] = rawurlencode($key) . '=' . rawurlencode($value);
        }
        $resource = '/' . $bucket . '/' . $channelName;

        $string_to_sign = $expires . "\n" . $cano_params . $resource;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $this->accessKeySecret, true));

        $query_items[] = 'OSSAccessKeyId=' . rawurlencode($this->accessKeyId);
        $query_items[] = 'Expires=' . rawurlencode($expires);
        $query_items[] = 'Signature=' . rawurlencode($signature);

        return $proto . $hostname . '/live/' . $channelName . '?' . implode('&', $query_items);
    }


    /**
     * Generates the signed pushing streaming url
     *
     * @param string $bucket bucket name
     * @param string $channelName channel name
     * @param int    $expiration expiration time of the Url, unix epoch, since 1970.1.1 00.00.00 UTC
     * @param array  $options
     * @return The signed pushing streaming url
     * @throws OssException
     */
    public function generatePresignedRtmpUrl($bucket, $channelName, $expiration, $options = NULL)
    {
        $this->precheckCommon($bucket, $channelName, $options, false);
        $proto = 'rtmp://';
        $hostname = $this->generateHostname($bucket);
        $cano_params = '';
        $query_items = array();
        $params = isset($options['params']) ? $options['params'] : array();
        uksort($params, 'strnatcasecmp');
        foreach ($params as $key => $value) {
            $cano_params = $cano_params . $key . ':' . $value . "\n";
            $query_items[] = rawurlencode($key) . '=' . rawurlencode($value);
        }
        $resource = '/' . $bucket . '/' . $channelName;

        $string_to_sign = $expiration . "\n" . $cano_params . $resource;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $this->accessKeySecret, true));

        $query_items[] = 'OSSAccessKeyId=' . rawurlencode($this->accessKeyId);
        $query_items[] = 'Expires=' . rawurlencode($expiration);
        $query_items[] = 'Signature=' . rawurlencode($signature);

        return $proto . $hostname . '/live/' . $channelName . '?' . implode('&', $query_items);
    }


    /**
     * 检验跨域资源请求, 发送跨域请求之前会发送一个preflight请求（OPTIONS）并带上特定的来源域，
     * HTTP方法和header信息等给OSS以决定是否发送真正的请求。 OSS可以通过putBucketCors接口
     * 来开启Bucket的CORS支持，开启CORS功能之后，OSS在收到浏览器preflight请求时会根据设定的
     * 规则评估是否允许本次请求
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $origin 请求来源域
     * @param string $request_method 表明实际请求中会使用的HTTP方法
     * @param string $request_headers 表明实际请求中会使用的除了简单头部之外的headers
     * @param array  $options
     * @return array
     * @throws InvalidUrl
     * @throws OssException
     * @link http://help.aliyun.com/document_detail/oss/api-reference/cors/OptionObject.html
     */
    public function optionsObject($bucket, $object, $origin, $request_method, $request_headers, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_OPTIONS;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_HEADERS] = array(
            OssConst::OSS_OPTIONS_ORIGIN          => $origin,
            OssConst::OSS_OPTIONS_REQUEST_HEADERS => $request_headers,
            OssConst::OSS_OPTIONS_REQUEST_METHOD  => $request_method
        );
        $response = $this->auth($options);
        $result = new HeaderResult($response);
        return $result->getData();
    }

    /**
     * 设置Bucket的Lifecycle配置
     *
     * @param string          $bucket bucket名称
     * @param LifecycleConfig $lifecycleConfig Lifecycle配置类
     * @param array           $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function putBucketLifecycle($bucket, $lifecycleConfig, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'lifecycle';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $lifecycleConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取Bucket的Lifecycle配置情况
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return LifecycleConfig
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketLifecycle($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'lifecycle';
        $response = $this->auth($options);
        $result = new GetLifecycleResult($response);
        return $result->getData();
    }

    /**
     * 删除指定Bucket的生命周期配置
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function deleteBucketLifecycle($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'lifecycle';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 设置一个bucket的referer访问白名单和是否允许referer字段为空的请求访问
     * Bucket Referer防盗链具体见OSS防盗链
     *
     * @param string        $bucket bucket名称
     * @param RefererConfig $refererConfig
     * @param array         $options
     * @return ResponseCore
     * @throws null
     */
    public function putBucketReferer($bucket, $refererConfig, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'referer';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $refererConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取Bucket的Referer配置情况
     * Bucket Referer防盗链具体见OSS防盗链
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return RefererConfig
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketReferer($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'referer';
        $response = $this->auth($options);
        $result = new GetRefererResult($response);
        return $result->getData();
    }

    /**
     * 设置bucket的容量大小，单位GB
     * 当bucket的容量大于设置的容量时，禁止继续写入
     *
     * @param string $bucket bucket名称
     * @param int    $storageCapacity
     * @param array  $options
     * @return ResponseCore
     * @throws null
     */
    public function putBucketStorageCapacity($bucket, $storageCapacity, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'qos';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $storageCapacityConfig = new StorageCapacityConfig($storageCapacity);
        $options[OssConst::OSS_CONTENT] = $storageCapacityConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取bucket的容量大小，单位GB
     *
     * @param string $bucket bucket名称
     * @param array  $options
     * @return int
     * @throws OssException
     * @throws InvalidUrl
     */
    public function getBucketStorageCapacity($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'qos';
        $response = $this->auth($options);
        $result = new GetStorageCapacityResult($response);
        return $result->getData();
    }


    /**
     * Get the information of the bucket
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return BucketInfo
     * @throws OssException
     */
    public function getBucketInfo($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'bucketInfo';
        $response = $this->auth($options);
        $result = new GetBucketInfoResult($response);
        return $result->getData();
    }

    /**
     * Get the stat of the bucket
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return BucketStat
     * @throws OssException
     */
    public function getBucketStat($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'stat';
        $response = $this->auth($options);
        $result = new GetBucketStatResult($response);
        return $result->getData();
    }

    /**
     * Sets the bucket's policy
     *
     * @param string $bucket bucket name
     * @param string $policy policy json format content
     * @param array  $options
     * @return null
     * @throws OssException
     */
    public function putBucketPolicy($bucket, $policy, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'policy';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/json';
        $options[OssConst::OSS_CONTENT] = $policy;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Gets bucket's policy
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return string policy json content
     * @throws OssException
     */
    public function getBucketPolicy($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'policy';
        $response = $this->auth($options);
        $result = new BodyResult($response);
        return $result->getData();
    }

    /**
     * Deletes the bucket's policy
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return null
     * @throws OssException
     */
    public function deleteBucketPolicy($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'policy';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Sets the bucket's encryption
     *
     * @param string                     $bucket bucket name
     * @param ServerSideEncryptionConfig $sseConfig
     * @param array                      $options
     * @return null
     * @throws OssException
     */
    public function putBucketEncryption($bucket, $sseConfig, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'encryption';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $options[OssConst::OSS_CONTENT] = $sseConfig->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Gets bucket's encryption
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return ServerSideEncryptionConfig
     * @throws OssException
     */
    public function getBucketEncryption($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'encryption';
        $response = $this->auth($options);
        $result = new GetBucketEncryptionResult($response);
        return $result->getData();
    }

    /**
     * Deletes the bucket's encryption
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return null
     * @throws OssException
     */
    public function deleteBucketEncryption($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'encryption';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Set the request playment of the bucket, Can be BucketOwner and Requester
     *
     * @param string $bucket bucket name
     * @param string $payer
     * @param array  $options
     * @return ResponseCore
     * @throws null
     */
    public function putBucketRequestPayment($bucket, $payer, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'requestPayment';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $config = new RequestPaymentConfig($payer);
        $options[OssConst::OSS_CONTENT] = $config->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Get the request playment of the bucket
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return string
     * @throws OssException
     */
    public function getBucketRequestPayment($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'requestPayment';
        $response = $this->auth($options);
        $result = new GetBucketRequestPaymentResult($response);
        return $result->getData();
    }

    /**
     * Set the versioning of the bucket, Can be BucketOwner and Requester
     *
     * @param string $bucket bucket name
     * @param string $status
     * @param array  $options
     * @return ResponseCore
     * @throws null
     */
    public function putBucketVersioning($bucket, $status, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'versioning';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $config = new VersioningConfig($status);
        $options[OssConst::OSS_CONTENT] = $config->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Get the versioning of the bucket
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return string
     * @throws OssException
     */
    public function getBucketVersioning($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'versioning';
        $response = $this->auth($options);
        $result = new GetBucketVersioningResult($response);
        return $result->getData();
    }

    /**
     * Initialize a bucket's worm
     *
     * @param string $bucket bucket name
     * @param int    $day
     * @param array  $options
     * @return string returns uploadid
     * @throws OssException
     */
    public function initiateBucketWorm($bucket, $day, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'worm';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $config = new InitiateWormConfig($day);
        $options[OssConst::OSS_CONTENT] = $config->serializeToXml();
        $response = $this->auth($options);
        $result = new InitiateBucketWormResult($response);
        return $result->getData();
    }

    /**
     * Aborts the bucket's worm
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return null
     * @throws OssException
     */
    public function abortBucketWorm($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'worm';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Complete a bucket's worm
     *
     * @param string $bucket bucket name
     * @param string $wormId
     * @param array  $options
     * @return string returns uploadid
     * @throws OssException
     */
    public function completeBucketWorm($bucket, $wormId, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_WORM_ID] = $wormId;
        $options[OssConst::OSS_CONTENT] = '';
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Extend a bucket's worm
     *
     * @param string $bucket bucket name
     * @param string $wormId
     * @param int    $day
     * @param array  $options
     * @return string returns uploadid
     * @throws OssException
     */
    public function extendBucketWorm($bucket, $wormId, $day, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_WORM_ID] = $wormId;
        $options[OssConst::OSS_SUB_RESOURCE] = 'wormExtend';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $config = new ExtendWormConfig($day);
        $options[OssConst::OSS_CONTENT] = $config->serializeToXml();
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Get a bucket's worm
     *
     * @param string $bucket bucket name
     * @param array  $options
     * @return string
     * @throws OssException
     */
    public function getBucketWorm($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'worm';
        $response = $this->auth($options);
        $result = new GetBucketWormResult($response);
        return $result->getData();
    }

    /**
     * 获取bucket下的object列表
     *
     * @param string $bucket
     * @param array  $options
     * 其中options中的参数如下
     * $options = array(
     *      'max-keys'  => max-keys用于限定此次返回object的最大数，如果不设定，默认为100，max-keys取值不能大于1000。
     *      'prefix'    => 限定返回的object key必须以prefix作为前缀。注意使用prefix查询时，返回的key中仍会包含prefix。
     *      'delimiter' => 是一个用于对Object名字进行分组的字符。所有名字包含指定的前缀且第一次出现delimiter字符之间的object作为一组元素
     *      'marker'    => 用户设定结果从marker之后按字母排序的第一个开始返回。
     *)
     * 其中 prefix，marker用来实现分页显示效果，参数的长度必须小于256字节。
     * @return ObjectListInfo
     * @throws OssException
     * @throws InvalidUrl
     */
    public function listObjects($bucket, $options = NULL)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $query = isset($options[OssConst::OSS_QUERY_STRING]) ? $options[OssConst::OSS_QUERY_STRING] : [];
        $options[OssConst::OSS_QUERY_STRING] = array_merge(
            $query,
            [
                OssConst::OSS_ENCODING_TYPE => OssConst::OSS_ENCODING_TYPE_URL,
                OssConst::OSS_DELIMITER     => isset($options[OssConst::OSS_DELIMITER]) ? $options[OssConst::OSS_DELIMITER] : '/',
                OssConst::OSS_PREFIX        => isset($options[OssConst::OSS_PREFIX]) ? $options[OssConst::OSS_PREFIX] : '',
                OssConst::OSS_MAX_KEYS      => isset($options[OssConst::OSS_MAX_KEYS]) ? $options[OssConst::OSS_MAX_KEYS] : OssConst::OSS_MAX_KEYS_VALUE,
                OssConst::OSS_MARKER        => isset($options[OssConst::OSS_MARKER]) ? $options[OssConst::OSS_MARKER] : ''
            ]
        );
        $response = $this->auth($options);
        $result = new ListObjectsResult($response);
        return $result->getData();
    }


    /**
     * Lists the bucket's object with version information (in ObjectListInfo)
     *
     * @param string $bucket
     * @param array $options are defined below:
     * $options = array(
     *      'max-keys'   => specifies max object count to return. By default is 100 and max value could be 1000.
     *      'prefix'     => specifies the key prefix the returned objects must have. Note that the returned keys still contain the prefix.
     *      'delimiter'  => The delimiter of object name for grouping object. When it's specified, listObjectVersions will differeniate the object and folder. And it will return subfolder's objects.
     *      'key-marker' => The key of returned object must be greater than the 'key-marker'.
     *      'version-id-marker' => The version id of returned object must be greater than the 'version-id-marker'.
     *)
     * Prefix and marker are for filtering and paging. Their length must be less than 256 bytes
     * @throws OssException
     * @return ObjectListInfo
     */
    public function listObjectVersions($bucket, $options = NULL)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'versions';
        $query = isset($options[OssConst::OSS_QUERY_STRING]) ? $options[OssConst::OSS_QUERY_STRING] : array();
        $options[OssConst::OSS_QUERY_STRING] = array_merge(
            $query,
            array(OssConst::OSS_ENCODING_TYPE => OssConst::OSS_ENCODING_TYPE_URL,
                  OssConst::OSS_DELIMITER => isset($options[OssConst::OSS_DELIMITER]) ? $options[OssConst::OSS_DELIMITER] : '/',
                  OssConst::OSS_PREFIX => isset($options[OssConst::OSS_PREFIX]) ? $options[OssConst::OSS_PREFIX] : '',
                  OssConst::OSS_MAX_KEYS => isset($options[OssConst::OSS_MAX_KEYS]) ? $options[OssConst::OSS_MAX_KEYS] : OssConst::OSS_MAX_KEYS_VALUE,
                  OssConst::OSS_KEY_MARKER => isset($options[OssConst::OSS_KEY_MARKER]) ? $options[OssConst::OSS_KEY_MARKER] : '',
                  OssConst::OSS_VERSION_ID_MARKER => isset($options[OssConst::OSS_VERSION_ID_MARKER]) ? $options[OssConst::OSS_VERSION_ID_MARKER] : '')
        );

        $response = $this->auth($options);
        $result = new ListObjectVersionsResult($response);
        return $result->getData();
    }
    /**
     * 创建虚拟目录 (本函数会在object名称后增加'/', 所以创建目录的object名称不需要'/'结尾，否则，目录名称会变成'//')
     *
     * 暂不开放此接口
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array  $options
     * @return null
     */
    public function createObjectDir($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $object . '/';
        $options[OssConst::OSS_CONTENT_LENGTH] = array(OssConst::OSS_CONTENT_LENGTH => 0);
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 上传内存中的内容
     *
     * @param string $bucket bucket名称
     * @param string $object objcet名称
     * @param string $content 上传的内容
     * @param array  $options
     * @return null
     */
    public function putObject($bucket, $object, $content, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);

        $options[OssConst::OSS_CONTENT] = $content;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $object;

        if (!isset($options[OssConst::OSS_LENGTH])) {
            $options[OssConst::OSS_CONTENT_LENGTH] = strlen($options[OssConst::OSS_CONTENT]);
        } else {
            $options[OssConst::OSS_CONTENT_LENGTH] = $options[OssConst::OSS_LENGTH];
        }

        $is_check_md5 = $this->isCheckMD5($options);
        if ($is_check_md5) {
            $content_md5 = base64_encode(md5($content, true));
            $options[OssConst::OSS_CONTENT_MD5] = $content_md5;
        }

        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object);
        }
        $response = $this->auth($options);

        if (isset($options[OssConst::OSS_CALLBACK]) && !empty($options[OssConst::OSS_CALLBACK])) {
            $result = new CallbackResult($response);
        } else {
            $result = new PutSetDeleteResult($response);
        }

        return $result->getData();
    }

    /**
     * 创建symlink
     * @param string $bucket bucket名称
     * @param string $symlink symlink名称
     * @param string $targetObject 目标object名称
     * @param array  $options
     * @return null
     */
    public function putSymlink($bucket, $symlink, $targetObject, $options = NULL)
    {
        $this->preCheckCommon($bucket, $symlink, $options);

        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $symlink;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_SYMLINK;
        $options[OssConst::OSS_HEADERS][OssConst::OSS_SYMLINK_TARGET] = rawurlencode($targetObject);

        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取symlink
     * @param string $bucket bucket名称
     * @param string $symlink symlink名称
     * @param array $options
     * @return null
     */
    public function getSymlink($bucket, $symlink, $options = NULL)
    {
        $this->preCheckCommon($bucket, $symlink, $options);

        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = $symlink;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_SYMLINK;

        $response = $this->auth($options);
        $result = new SymlinkResult($response);
        return $result->getData();
    }

    /**
     * 上传本地文件
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $file 本地文件路径
     * @param array  $options
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function uploadFile($bucket, $object, $file, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        OssUtil::throwOssExceptionWithMessageIfEmpty($file, "file path is invalid");
        $file = OssUtil::encodePath($file);
        if (!file_exists($file)) {
            throw new OssException($file . " file does not exist");
        }
        $options[OssConst::OSS_FILE_UPLOAD] = $file;
        $file_size = filesize($options[OssConst::OSS_FILE_UPLOAD]);
        $is_check_md5 = $this->isCheckMD5($options);
        if ($is_check_md5) {
            $content_md5 = base64_encode(md5_file($options[OssConst::OSS_FILE_UPLOAD], true));
            $options[OssConst::OSS_CONTENT_MD5] = $content_md5;
        }
        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object, $file);
        }
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_CONTENT_LENGTH] = $file_size;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * Uploads object from file handle
     *
     * @param string $bucket bucket name
     * @param string $object object name
     * @param resource $handle file handle
     * @param array $options
     * @return null
     * @throws OssException
     */
    public function uploadStream($bucket, $object, $handle, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        if (!is_resource($handle)) {
            throw new OssException("The handle must be an opened stream");
        }
        $options[OssConst::OSS_FILE_UPLOAD] = $handle;
        if ($this->isCheckMD5($options)) {
            rewind($handle);
            $ctx = hash_init('md5');
            hash_update_stream($ctx, $handle);
            $content_md5 = base64_encode(hash_final($ctx, true));
            rewind($handle);
            $options[OssConst::OSS_CONTENT_MD5] = $content_md5;
        }
        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object);
        }
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        if (!isset($options[OssConst::OSS_CONTENT_LENGTH])) {
            $options[OssConst::OSS_CONTENT_LENGTH] = fstat($handle)[OssConst::OSS_SIZE];
        }
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 追加上传内存中的内容
     *
     * @param string $bucket bucket名称
     * @param string $object objcet名称
     * @param string $content 本次追加上传的内容
     * @param array  $options
     * @return int next append position
     * @throws InvalidUrl
     * @throws OssException
     */
    public function appendObject($bucket, $object, $content, $position, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);

        $options[OssConst::OSS_CONTENT] = $content;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = 'append';
        $options[OssConst::OSS_POSITION] = strval($position);

        if (!isset($options[OssConst::OSS_LENGTH])) {
            $options[OssConst::OSS_CONTENT_LENGTH] = strlen($options[OssConst::OSS_CONTENT]);
        } else {
            $options[OssConst::OSS_CONTENT_LENGTH] = $options[OssConst::OSS_LENGTH];
        }

        $is_check_md5 = $this->isCheckMD5($options);
        if ($is_check_md5) {
            $content_md5 = base64_encode(md5($content, true));
            $options[OssConst::OSS_CONTENT_MD5] = $content_md5;
        }

        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object);
        }
        $response = $this->auth($options);
        $result = new AppendResult($response);
        return $result->getData();
    }

    /**
     * 追加上传本地文件
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $file 追加上传的本地文件路径
     * @param array  $options
     * @return int next append position
     * @throws InvalidUrl
     * @throws OssException
     */
    public function appendFile($bucket, $object, $file, $position, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);

        OssUtil::throwOssExceptionWithMessageIfEmpty($file, "file path is invalid");
        $file = OssUtil::encodePath($file);
        if (!file_exists($file)) {
            throw new OssException($file . " file does not exist");
        }
        $options[OssConst::OSS_FILE_UPLOAD] = $file;
        $file_size = filesize($options[OssConst::OSS_FILE_UPLOAD]);
        $is_check_md5 = $this->isCheckMD5($options);
        if ($is_check_md5) {
            $content_md5 = base64_encode(md5_file($options[OssConst::OSS_FILE_UPLOAD], true));
            $options[OssConst::OSS_CONTENT_MD5] = $content_md5;
        }
        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object, $file);
        }

        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_CONTENT_LENGTH] = $file_size;
        $options[OssConst::OSS_SUB_RESOURCE] = 'append';
        $options[OssConst::OSS_POSITION] = strval($position);

        $response = $this->auth($options);
        $result = new AppendResult($response);
        return $result->getData();
    }

    /**
     * 拷贝一个在OSS上已经存在的object成另外一个object
     *
     * @param string $fromBucket 源bucket名称
     * @param string $fromObject 源object名称
     * @param string $toBucket 目标bucket名称
     * @param string $toObject 目标object名称
     * @param array  $options
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function copyObject($fromBucket, $fromObject, $toBucket, $toObject, $options = NULL)
    {
        $this->preCheckCommon($fromBucket, $fromObject, $options);
        $this->preCheckCommon($toBucket, $toObject, $options);
        $options[OssConst::OSS_BUCKET] = $toBucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_OBJECT] = $toObject;
        $param = '/' . $fromBucket . '/' . rawurlencode($fromObject);
        if (isset($options[OssConst::OSS_VERSION_ID])) {
            $param = $param . '?versionId='.$options[OssConst::OSS_VERSION_ID];
            unset($options[OssConst::OSS_VERSION_ID]);
        }
        if (isset($options[OssConst::OSS_HEADERS])) {
            $options[OssConst::OSS_HEADERS][OssConst::OSS_OBJECT_COPY_SOURCE] = '/' . $fromBucket . '/' . $fromObject;
        } else {
            $options[OssConst::OSS_HEADERS] = array(OssConst::OSS_OBJECT_COPY_SOURCE => '/' . $fromBucket . '/' . $fromObject);
        }
        $response = $this->auth($options);
        $result = new CopyObjectResult($response);
        return $result->getData();
    }

    /**
     * 获取Object的Meta信息
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $options 具体参考SDK文档
     * @return array
     */
    public function getObjectMeta($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_HEAD;
        $options[OssConst::OSS_OBJECT] = $object;
        $response = $this->auth($options);
        $result = new HeaderResult($response);
        return $result->getData();
    }

    /**
     * Gets the simplified metadata of a object.
     * Simplified metadata includes ETag, Size, LastModified.
     *
     * @param string $bucket bucket name
     * @param string $object object name
     * @param string $options Checks out the SDK document for the detail
     * @return array
     */
    public function getSimplifiedObjectMeta($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_HEAD;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = 'objectMeta';
        $response = $this->auth($options);
        $result = new HeaderResult($response);
        return $result->getData();
    }

    /**
     * 删除某个Object
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array  $options
     * @return null
     */
    public function deleteObject($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_OBJECT] = $object;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 删除同一个Bucket中的多个Object
     *
     * @param string $bucket bucket名称
     * @param array  $objects object列表
     * @param array  $options
     * @return ResponseCore
     * @throws null
     */
    public function deleteObjects($bucket, $objects, $options = null)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        if (!is_array($objects) || !$objects) {
            throw new OssException('objects must be array');
        }
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'delete';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $quiet = 'false';
        if (isset($options['quiet'])) {
            if (is_bool($options['quiet'])) { //Boolean
                $quiet = $options['quiet'] ? 'true' : 'false';
            } elseif (is_string($options['quiet'])) { // string
                $quiet = ($options['quiet'] === 'true') ? 'true' : 'false';
            }
        }
        $xmlBody = OssUtil::createDeleteObjectsXmlBody($objects, $quiet);
        $options[OssConst::OSS_CONTENT] = $xmlBody;
        $response = $this->auth($options);
        $result = new DeleteObjectsResult($response);
        return $result->getData();
    }

    /**
     * Deletes multiple objects with version id in a bucket
     *
     * @param string $bucket bucket name
     * @param array $objects DeleteObjectInfo list
     * @param array $options
     * @return ResponseCore
     * @throws null
     */
    public function deleteObjectVersions($bucket, $objects, $options = null)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        if (!is_array($objects) || !$objects) {
            throw new OssException('objects must be array');
        }
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'delete';
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        $quiet = 'false';
        if (isset($options['quiet'])) {
            if (is_bool($options['quiet'])) { //Boolean
                $quiet = $options['quiet'] ? 'true' : 'false';
            } elseif (is_string($options['quiet'])) { // string
                $quiet = ($options['quiet'] === 'true') ? 'true' : 'false';
            }
        }
        $xmlBody = OssUtil::createDeleteObjectVersionsXmlBody($objects, $quiet);
        $options[OssConst::OSS_CONTENT] = $xmlBody;
        $response = $this->auth($options);
        $result = new DeleteObjectVersionsResult($response);
        return $result->getData();
    }

    /**
     * 获得Object内容
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array  $options 该参数中必须设置ALIOSS::OSS_FILE_DOWNLOAD，ALIOSS::OSS_RANGE可选，可以根据实际情况设置；如果不设置，默认会下载全部内容
     * @return string
     */
    public function getObject($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_OBJECT] = $object;
        if (isset($options[OssConst::OSS_LAST_MODIFIED])) {
            $options[OssConst::OSS_HEADERS][OssConst::OSS_IF_MODIFIED_SINCE] = $options[OssConst::OSS_LAST_MODIFIED];
            unset($options[OssConst::OSS_LAST_MODIFIED]);
        }
        if (isset($options[OssConst::OSS_ETAG])) {
            $options[OssConst::OSS_HEADERS][OssConst::OSS_IF_NONE_MATCH] = $options[OssConst::OSS_ETAG];
            unset($options[OssConst::OSS_ETAG]);
        }
        if (isset($options[OssConst::OSS_RANGE])) {
            $range = $options[OssConst::OSS_RANGE];
            $options[OssConst::OSS_HEADERS][OssConst::OSS_RANGE] = "bytes=$range";
            unset($options[OssConst::OSS_RANGE]);
        }
        $response = $this->auth($options);
        $result = new BodyResult($response);
        return $result->getData();
    }

    /**
     * 检测Object是否存在
     * 通过获取Object的Meta信息来判断Object是否存在， 用户需要自行解析ResponseCore判断object是否存在
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array  $options
     * @return bool
     */
    public function doesObjectExist($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_HEAD;
        $options[OssConst::OSS_OBJECT] = $object;
        $response = $this->auth($options);
        $result = new ExistResult($response);
        return $result->getData();
    }

    /**
     * 针对Archive类型的Object读取
     * 需要使用Restore操作让服务端执行解冻任务
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function restoreObject($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = OssConst::OSS_RESTORE;
        if (isset($options[OssConst::OSS_RESTORE_CONFIG])) {
            $config = $options[OssConst::OSS_RESTORE_CONFIG];
            $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
            $options[OssConst::OSS_CONTENT] = $config->serializeToXml();
        }
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获取分片大小，根据用户提供的part_size，重新计算一个更合理的partsize
     *
     * @param int $partSize
     * @return int
     */
    private function computePartSize($partSize)
    {
        $partSize = (integer)$partSize;
        if ($partSize <= OssConst::OSS_MIN_PART_SIZE) {
            $partSize = OssConst::OSS_MIN_PART_SIZE;
        } elseif ($partSize > OssConst::OSS_MAX_PART_SIZE) {
            $partSize = OssConst::OSS_MAX_PART_SIZE;
        }
        return $partSize;
    }

    /**
     * 计算文件可以分成多少个part，以及每个part的长度以及起始位置
     * 方法必须在 <upload_part()>中调用
     *
     * @param integer $file_size 文件大小
     * @param integer $partSize part大小,默认5M
     * @return array An array 包含 key-value 键值对. Key 为 `seekTo` 和 `length`.
     */
    public function generateMultiUploadParts($file_size, $partSize = 5242880)
    {
        $i = 0;
        $size_count = $file_size;
        $values = array();
        $partSize = $this->computePartSize($partSize);
        while ($size_count > 0) {
            $size_count -= $partSize;
            $values[] = array(
                OssConst::OSS_SEEK_TO => ($partSize * $i),
                OssConst::OSS_LENGTH  => (($size_count > 0) ? $partSize : ($size_count + $partSize)),
            );
            $i++;
        }
        return $values;
    }

    /**
     * 初始化multi-part upload
     *
     * @param string $bucket Bucket名称
     * @param string $object Object名称
     * @param array  $options Key-Value数组
     * @return string 返回uploadid
     * @throws OssException
     * @throws InvalidUrl
     */
    public function initiateMultipartUpload($bucket, $object, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_SUB_RESOURCE] = 'uploads';
        $options[OssConst::OSS_CONTENT] = '';

        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object);
        }
        if (!isset($options[OssConst::OSS_HEADERS])) {
            $options[OssConst::OSS_HEADERS] = array();
        }
        $response = $this->auth($options);
        $result = new InitiateMultipartUploadResult($response);
        return $result->getData();
    }

    /**
     * 分片上传的块上传接口
     *
     * @param string $bucket Bucket名称
     * @param string $object Object名称
     * @param string $uploadId
     * @param array  $options Key-Value数组
     * @return string eTag
     * @throws InvalidUrl
     * @throws OssException
     */
    public function uploadPart($bucket, $object, $uploadId, $options = null)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $this->preCheckParam($options, OssConst::OSS_FILE_UPLOAD, __FUNCTION__);
        $this->preCheckParam($options, OssConst::OSS_PART_NUM, __FUNCTION__);

        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_UPLOAD_ID] = $uploadId;

        if (isset($options[OssConst::OSS_LENGTH])) {
            $options[OssConst::OSS_CONTENT_LENGTH] = $options[OssConst::OSS_LENGTH];
        }
        $response = $this->auth($options);
        $result = new UploadPartResult($response);
        return $result->getData();
    }

    /**
     * 获取已成功上传的part
     *
     * @param string $bucket Bucket名称
     * @param string $object Object名称
     * @param string $uploadId uploadId
     * @param array  $options Key-Value数组
     * @return ListPartsInfo
     * @throws InvalidUrl
     * @throws OssException
     */
    public function listParts($bucket, $object, $uploadId, $options = null)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_UPLOAD_ID] = $uploadId;
        $options[OssConst::OSS_QUERY_STRING] = array();
        foreach (array('max-parts', 'part-number-marker') as $param) {
            if (isset($options[$param])) {
                $options[OssConst::OSS_QUERY_STRING][$param] = $options[$param];
                unset($options[$param]);
            }
        }
        $response = $this->auth($options);
        $result = new ListPartsResult($response);
        return $result->getData();
    }

    /**
     * 中止进行一半的分片上传操作
     *
     * @param string $bucket Bucket名称
     * @param string $object Object名称
     * @param string $uploadId uploadId
     * @param array  $options Key-Value数组
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function abortMultipartUpload($bucket, $object, $uploadId, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_DELETE;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_UPLOAD_ID] = $uploadId;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 在将所有数据Part都上传完成后，调用此接口完成本次分块上传
     *
     * @param string $bucket Bucket名称
     * @param string $object Object名称
     * @param string $uploadId uploadId
     * @param array  $listParts array( array("PartNumber"=> int, "ETag"=>string))
     * @param array  $options Key-Value数组
     * @return null
     * @throws OssException
     * @throws InvalidUrl
     */
    public function completeMultipartUpload($bucket, $object, $uploadId, $listParts, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_POST;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_UPLOAD_ID] = $uploadId;
        $options[OssConst::OSS_CONTENT_TYPE] = 'application/xml';
        if (!is_array($listParts)) {
            throw new OssException("listParts must be array type");
        }
        $options[OssConst::OSS_CONTENT] = OssUtil::createCompleteMultipartUploadXmlBody($listParts);
        $response = $this->auth($options);
//        var_dump($response);
        if (isset($options[OssConst::OSS_CALLBACK]) && !empty($options[OssConst::OSS_CALLBACK])) {
            $result = new CallbackResult($response);
        } else {
            $result = new PutSetDeleteResult($response);
        }

        return $result->getData();
    }

    /**
     * 罗列出所有执行中的Multipart Upload事件，即已经被初始化的Multipart Upload但是未被
     * Complete或者Abort的Multipart Upload事件
     *
     * @param string $bucket bucket
     * @param array  $options 关联数组
     * @return ListMultipartUploadInfo
     * @throws OssException
     * @throws InvalidUrl
     */
    public function listMultipartUploads($bucket, $options = null)
    {
        $this->preCheckCommon($bucket, NULL, $options, false);
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_GET;
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = '/';
        $options[OssConst::OSS_SUB_RESOURCE] = 'uploads';

        foreach (array('delimiter', 'key-marker', 'max-uploads', 'prefix', 'upload-id-marker') as $param) {
            if (isset($options[$param])) {
                $options[OssConst::OSS_QUERY_STRING][$param] = $options[$param];
                unset($options[$param]);
            }
        }
        $query = isset($options[OssConst::OSS_QUERY_STRING]) ? $options[OssConst::OSS_QUERY_STRING] : array();
        $options[OssConst::OSS_QUERY_STRING] = array_merge(
            $query,
            array(OssConst::OSS_ENCODING_TYPE => OssConst::OSS_ENCODING_TYPE_URL)
        );

        $response = $this->auth($options);
        $result = new ListMultipartUploadResult($response);
        return $result->getData();
    }

    /**
     * 从一个已存在的Object中拷贝数据来上传一个Part
     *
     * @param string $fromBucket 源bucket名称
     * @param string $fromObject 源object名称
     * @param string $toBucket 目标bucket名称
     * @param string $toObject 目标object名称
     * @param int    $partNumber 分块上传的块id
     * @param string $uploadId 初始化multipart upload返回的uploadid
     * @param array  $options Key-Value数组
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function uploadPartCopy($fromBucket, $fromObject, $toBucket, $toObject, $partNumber, $uploadId, $options = NULL)
    {
        $this->preCheckCommon($fromBucket, $fromObject, $options);
        $this->preCheckCommon($toBucket, $toObject, $options);

        //如果没有设置$options['isFullCopy']，则需要强制判断copy的起止位置
        $start_range = "0";
        if (isset($options['start'])) {
            $start_range = $options['start'];
        }
        $end_range = "";
        if (isset($options['end'])) {
            $end_range = $options['end'];
        }
        $options[OssConst::OSS_METHOD] = OssConst::OSS_HTTP_PUT;
        $options[OssConst::OSS_BUCKET] = $toBucket;
        $options[OssConst::OSS_OBJECT] = $toObject;
        $options[OssConst::OSS_PART_NUM] = $partNumber;
        $options[OssConst::OSS_UPLOAD_ID] = $uploadId;

        if (!isset($options[OssConst::OSS_HEADERS])) {
            $options[OssConst::OSS_HEADERS] = array();
        }

        $options[OssConst::OSS_HEADERS][OssConst::OSS_OBJECT_COPY_SOURCE] = '/' . $fromBucket . '/' . $fromObject;
        $options[OssConst::OSS_HEADERS][OssConst::OSS_OBJECT_COPY_SOURCE_RANGE] = "bytes=" . $start_range . "-" . $end_range;
        $response = $this->auth($options);
        $result = new UploadPartResult($response);
        return $result->getData();
    }

    /**
     * multipart上传统一封装，从初始化到完成multipart，以及出错后中止动作
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $file 需要上传的本地文件的路径
     * @param array  $options Key-Value数组
     * @return null
     * @throws InvalidUrl
     * @throws OssException
     */
    public function multiUploadFile($bucket, $object, $file, $options = null)
    {
        $this->preCheckCommon($bucket, $object, $options);
        if (isset($options[OssConst::OSS_LENGTH])) {
            $options[OssConst::OSS_CONTENT_LENGTH] = $options[OssConst::OSS_LENGTH];
            unset($options[OssConst::OSS_LENGTH]);
        }
        if (empty($file)) {
            throw new OssException("parameter invalid, file is empty");
        }
        $uploadFile = OssUtil::encodePath($file);
        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = $this->getMimeType($object, $uploadFile);
        }

        $upload_position = isset($options[OssConst::OSS_SEEK_TO]) ? (integer)$options[OssConst::OSS_SEEK_TO] : 0;

        if (isset($options[OssConst::OSS_CONTENT_LENGTH])) {
            $upload_file_size = (integer)$options[OssConst::OSS_CONTENT_LENGTH];
        } else {
            $upload_file_size = filesize($uploadFile);
            if ($upload_file_size !== false) {
                $upload_file_size -= $upload_position;
            }
        }

        if ($upload_position === false || !isset($upload_file_size) || $upload_file_size === false || $upload_file_size < 0) {
            throw new OssException('The size of `fileUpload` cannot be determined in ' . __FUNCTION__ . '().');
        }
        // 处理partSize
        if (isset($options[OssConst::OSS_PART_SIZE])) {
            $options[OssConst::OSS_PART_SIZE] = $this->computePartSize($options[OssConst::OSS_PART_SIZE]);
        } else {
            $options[OssConst::OSS_PART_SIZE] = OssConst::OSS_MID_PART_SIZE;
        }

        $is_check_md5 = $this->isCheckMD5($options);
        // 如果上传的文件小于partSize,则直接使用普通方式上传
        if ($upload_file_size < $options[OssConst::OSS_PART_SIZE] && !isset($options[OssConst::OSS_UPLOAD_ID])) {
            return $this->uploadFile($bucket, $object, $uploadFile, $options);
        }

        // 初始化multipart
        if (isset($options[OssConst::OSS_UPLOAD_ID])) {
            $uploadId = $options[OssConst::OSS_UPLOAD_ID];
        } else {
            // 初始化
            $uploadId = $this->initiateMultipartUpload($bucket, $object, $options);
        }
        // 获取的分片
        $pieces = $this->generateMultiuploadParts($upload_file_size, (integer)$options[OssConst::OSS_PART_SIZE]);
        $response_upload_part = array();
        foreach ($pieces as $i => $piece) {
            $from_pos = $upload_position + (integer)$piece[OssConst::OSS_SEEK_TO];
            $to_pos = (integer)$piece[OssConst::OSS_LENGTH] + $from_pos - 1;
            $up_options = array(
                OssConst::OSS_FILE_UPLOAD => $uploadFile,
                OssConst::OSS_PART_NUM    => ($i + 1),
                OssConst::OSS_SEEK_TO     => $from_pos,
                OssConst::OSS_LENGTH      => $to_pos - $from_pos + 1,
                OssConst::OSS_CHECK_MD5   => $is_check_md5,
            );
            if ($is_check_md5) {
                $content_md5 = OssUtil::getMd5SumForFile($uploadFile, $from_pos, $to_pos);
                $up_options[OssConst::OSS_CONTENT_MD5] = $content_md5;
            }
            $response_upload_part[] = $this->uploadPart($bucket, $object, $uploadId, $up_options);
        }

        $uploadParts = array();
        foreach ($response_upload_part as $i => $etag) {
            $uploadParts[] = array(
                'PartNumber' => ($i + 1),
                'ETag'       => $etag,
            );
        }
        return $this->completeMultipartUpload($bucket, $object, $uploadId, $uploadParts);
    }

    /**
     * 上传本地目录内的文件或者目录到指定bucket的指定prefix的object中
     *
     * @param string $bucket bucket名称
     * @param string $prefix 需要上传到的object的key前缀，可以理解成bucket中的子目录，结尾不能是'/'，接口中会补充'/'
     * @param string $localDirectory 需要上传的本地目录
     * @param string $exclude 需要排除的目录
     * @param bool   $recursive 是否递归的上传localDirectory下的子目录内容
     * @param bool   $checkMd5
     * @return array 返回两个列表 array("succeededList" => array("object"), "failedList" => array("object"=>"errorMessage"))
     * @throws InvalidUrl
     * @throws OssException
     */
    public function uploadDir($bucket, $prefix, $localDirectory, $exclude = '.|..|.svn|.git', $recursive = false, $checkMd5 = true)
    {
        $retArray = array("succeededList" => array(), "failedList" => array());
        if (empty($bucket)) throw new OssException("parameter error, bucket is empty");
        if (!is_string($prefix)) throw new OssException("parameter error, prefix is not string");
        if (empty($localDirectory)) throw new OssException("parameter error, localDirectory is empty");
        $directory = $localDirectory;
        $directory = OssUtil::encodePath($directory);
        //判断是否目录
        if (!is_dir($directory)) {
            throw new OssException('parameter error: ' . $directory . ' is not a directory, please check it');
        }
        //read directory
        $file_list_array = OssUtil::readDir($directory, $exclude, $recursive);
        if (!$file_list_array) {
            throw new OssException($directory . ' is empty...');
        }
        foreach ($file_list_array as $k => $item) {
            if (is_dir($item['path'])) {
                continue;
            }
            $options = array(
                OssConst::OSS_PART_SIZE => OssConst::OSS_MIN_PART_SIZE,
                OssConst::OSS_CHECK_MD5 => $checkMd5,
            );
            $realObject = (!empty($prefix) ? $prefix . '/' : '') . $item['file'];

            try {
                $this->multiUploadFile($bucket, $realObject, $item['path'], $options);
                $retArray["succeededList"][] = $realObject;
            } catch (OssException $e) {
                $retArray["failedList"][$realObject] = $e->getMessage();
            }
        }
        return $retArray;
    }

    /**
     * 支持生成get和put签名, 用户可以生成一个具有一定有效期的
     * 签名过的url
     *
     * @param string $bucket
     * @param string $object
     * @param int    $timeout
     * @param string $method
     * @param array  $options Key-Value数组
     * @return string
     * @throws InvalidUrl
     * @throws OssException
     */
    public function signUrl($bucket, $object, $timeout = 60, $method = OssConst::OSS_HTTP_GET, $options = NULL)
    {
        $this->preCheckCommon($bucket, $object, $options);
        //method
        if (OssConst::OSS_HTTP_GET !== $method && OssConst::OSS_HTTP_PUT !== $method) {
            throw new OssException("method is invalid");
        }
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_METHOD] = $method;
//        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
//            $options[OssConst::OSS_CONTENT_TYPE] = '';
//        }
        $timeout = time() + $timeout;
        $options[OssConst::OSS_PREAUTH] = $timeout;
        $options[OssConst::OSS_DATE] = $timeout;
        $this->setSignStsInUrl(true);
        return $this->auth($options);
    }

    /**
     * Sign URL with specified expiration time in seconds and HTTP method.
     * The signed URL could be used to access the object directly.
     *
     * @param string $bucket
     * @param string $object
     * @param int $expiration expiration time of the Url, unix epoch, since 1970.1.1 00.00.00 UTC
     * @param string $method
     * @param array $options Key-Value array
     * @return string
     * @throws OssException
     */
    public function generatePresignedUrl($bucket, $object, $expiration, $method = OssConst::OSS_HTTP_GET, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        //method
        if (OssConst::OSS_HTTP_GET !== $method && OssConst::OSS_HTTP_PUT !== $method) {
            throw new OssException("method is invalid");
        }
        $options[OssConst::OSS_BUCKET] = $bucket;
        $options[OssConst::OSS_OBJECT] = $object;
        $options[OssConst::OSS_METHOD] = $method;
        if (!isset($options[OssConst::OSS_CONTENT_TYPE])) {
            $options[OssConst::OSS_CONTENT_TYPE] = '';
        }
        $options[OssConst::OSS_PREAUTH] = $expiration;
        $options[OssConst::OSS_DATE] = $expiration;
        $this->setSignStsInUrl(true);
        return $this->auth($options);
    }

    ##############################请求方法#######################################

    ##############################请求#########################################

    /**
     * auth
     * 验证并且执行请求，按照OSS Api协议，执行操作
     * @param array $options
     * @return Response
     * @throws InvalidUrl
     * @throws OssException
     * @throws \EasySwoole\HttpClient\Exception\InvalidUrl
     * @author Tioncico
     * Time: 15:43
     */
    public function auth(array $options)
    {
        $config = $this->config;
        OssUtil::validateOptions($options);
        $this->authPreCheckBucket($options);
        $this->authPreCheckObject($options);
        $this->authPreCheckObjectEncoding($options);
        //验证ACL
        $this->authpreCheckAcl($options);

        //签名类
        $signature = new Signature($config);
        $queryStringParams = $signature->generateSignableQueryStringParam($options, $this->enableStsInUrl, $this->securityToken);
        //get参数拼接
        $signableQueryString = OssUtil::toQueryString($queryStringParams);
        //请求链接生成以及返回get字符串
        list($conjunction, $signableQueryString) = $this->generateRequestUrl($options, $signableQueryString);
        //如果get参数不为空,则增加$conjunction拼接符
        //创建请求
        $httpClient = new HttpClient();
        $httpClient->setTimeout($this->timeout);;
        $httpClient->setConnectTimeout($this->connectTimeout);;
        //请求链接
        $httpClient->setUrl($this->requestUrl);
        //设置http请求方法
        $this->setHttpClientMethod($httpClient, $options);
        //设置http请求内容
        $this->setHttpClientData($httpClient, $options);
        //清除原有header并设置user-agent
        $httpClient->setHeader('User-Agent', $this->generateUserAgent(), false);
        $httpClient->setHeader('Referer', $this->requestUrl);
        //设置文件上传
        $this->setHttpClientFileStream($httpClient, $options);
        //设置代理
        if ($this->requestProxy) {
            $httpClient->setProxyHttp(...$this->requestProxy);
        }

        //组装headers
        $headers = new RequestHeaders($config);
        // 获得当次请求使用的hostname，如果是公共域名或者专有域名，bucket拼在前面构成三级域名
        $hostname = $this->generateHostname($options[OssConst::OSS_BUCKET]);
        $headers = $headers->generateHeaders($options, $hostname, $this);
        $this->setHttpClientHeaders($httpClient, $headers);
        //签名字符串
        $stringToSign = $signature->getStringToSign($signableQueryString, $options, $headers, $this->hostType);
        //对?后面的要签名的string字母序排序
        $stringToSignOrdered = $signature->stringToSignSorted($stringToSign);
        $signatureStr = $signature->getSign($stringToSignOrdered);
        $authorization = 'OSS ' . $this->config->getAccessKeyId() . ':' . $signatureStr;
        $httpClient->setHeader('Authorization', $authorization, false);

        //如果是预检url,则直接返回
        if (($url = $this->preAuth($options, $signatureStr, $conjunction)) !== null) {
            return $url;
        }

        //请求数据并处理
        $redirects = 0;
        //如果是500则重试
        while ($redirects <= $this->maxRetries) {
            try {
                $response = new Response($httpClient->request($options)->toArray());
                $response->setOssRedirects($redirects);
                $response->setOssStringToSign($stringToSign);
                $response->setOssRequestUrl($this->requestUrl);
                if ($response->getStatusCode() == '500') {
                    //设置休眠
                    $delay = (integer)(pow(4, $redirects));
                    Coroutine::sleep($delay);
                    $redirects++;
                    continue;
                }
                $this->downFile($response, $options);
                break;
            } catch (\Throwable $throwable) {
                $redirects++;
                if ($redirects >= $this->maxRetries) {
                    throw  new OssException($throwable->getMessage(), $throwable->getCode());
                }
            }
        }
        return $response;
    }


    ##############################请求##########################################

    ###############################参数验证#########################################
    /**
     * 检查endpoint的种类
     * 如有有协议头，剥去协议头
     * 并且根据参数 is_cname 和endpoint本身，判定域名类型，是ip，cname，还是专有域或者官网域名
     *
     * @return string 剥掉协议头的域名
     */
    private function checkEndpoint()
    {
        $retEndpoint = null;
        $config = $this->config;
        $endpoint = $config->getEndpoint();
        $isCName = $config->isCName();
        if (strpos($endpoint, 'http://') === 0) {
            $retEndpoint = substr($endpoint, strlen('http://'));
        } elseif (strpos($endpoint, 'https://') === 0) {
            $retEndpoint = substr($endpoint, strlen('https://'));
            $this->useSSL = true;
        } else {
            $retEndpoint = $endpoint;
        }

        if ($isCName) {
            $this->hostType = OssConst::OSS_HOST_TYPE_CNAME;
        } elseif (OssUtil::isIPFormat($retEndpoint)) {
            $this->hostType = OssConst::OSS_HOST_TYPE_IP;
        } else {
            $this->hostType = OssConst::OSS_HOST_TYPE_NORMAL;
        }
        return $retEndpoint;
    }

    /**
     * Sets the max retry count
     *
     * @param int $maxRetries
     * @return void
     */
    public function setMaxTries($maxRetries = 3)
    {
        $this->maxRetries = $maxRetries;
    }

    /**
     * Gets the max retry count
     *
     * @return int
     */
    public function getMaxRetries()
    {
        return $this->maxRetries;
    }

    /**
     * Enaable/disable STS in the URL. This is to determine the $sts value passed from constructor take effect or not.
     *
     * @param boolean $enable
     */
    public function setSignStsInUrl($enable)
    {
        $this->enableStsInUrl = $enable;
    }

    /**
     * @return bool
     */
    public function isEnableStsInUrl(): bool
    {
        return $this->enableStsInUrl;
    }

    /**
     * @param bool $enableStsInUrl
     */
    public function setEnableStsInUrl(bool $enableStsInUrl): void
    {
        $this->enableStsInUrl = $enableStsInUrl;
    }

    /**
     * @return null
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }

    /**
     * @param null $securityToken
     */
    public function setSecurityToken($securityToken): void
    {
        $this->securityToken = $securityToken;
    }

    /**
     * @return boolean
     */
    public function isUseSSL()
    {
        return $this->useSSL;
    }

    /**
     * @param boolean $useSSL
     */
    public function setUseSSL($useSSL)
    {
        $this->useSSL = $useSSL;
    }

    /**
     * Validates bucket name--throw OssException if it's invalid
     *
     * @param $options
     * @throws OssException
     */
    private function authPreCheckBucket($options)
    {
        if (!(('/' == $options[OssConst::OSS_OBJECT]) && ('' == $options[OssConst::OSS_BUCKET]) && ('GET' == $options[OssConst::OSS_METHOD])) && !OssUtil::validateBucket($options[OssConst::OSS_BUCKET])) {
            throw new OssException('"' . $options[OssConst::OSS_BUCKET] . '"' . 'bucket name is invalid');
        }
    }

    /**
     *
     * Validates the object name--throw OssException if it's invalid.
     *
     * @param $options
     * @throws OssException
     */
    private function authPreCheckObject($options)
    {
        if (isset($options[OssConst::OSS_OBJECT]) && $options[OssConst::OSS_OBJECT] === '/') {
            return;
        }

        if (isset($options[OssConst::OSS_OBJECT]) && !OssUtil::validateObject($options[OssConst::OSS_OBJECT])) {
            throw new OssException('"' . $options[OssConst::OSS_OBJECT] . '"' . ' object name is invalid');
        }
    }

    /**
     * 检查object的编码，如果是gbk或者gb2312则尝试将其转化为utf8编码
     *
     * @param mixed $options 参数
     */
    private function authPreCheckObjectEncoding(&$options)
    {
        $tmpObject = $options[OssConst::OSS_OBJECT];
        try {
            if (OssUtil::isGb2312($options[OssConst::OSS_OBJECT])) {
                $options[OssConst::OSS_OBJECT] = iconv('GB2312', "UTF-8//IGNORE", $options[OssConst::OSS_OBJECT]);
            } elseif (OssUtil::checkChar($options[OssConst::OSS_OBJECT], true)) {
                $options[OssConst::OSS_OBJECT] = iconv('GBK', "UTF-8//IGNORE", $options[OssConst::OSS_OBJECT]);
            }
        } catch (\Exception $e) {
            try {
                $tmpObject = iconv(mb_detect_encoding($tmpObject), "UTF-8", $tmpObject);
            } catch (\Exception $e) {
            }
        }
        $options[OssConst::OSS_OBJECT] = $tmpObject;
    }

    /**
     * 检查ACL是否是预定义中三种之一，如果不是抛出异常
     *
     * @param $options
     * @throws InvalidUrl
     * @throws OssException
     */
    private function authpreCheckAcl($options)
    {
        if (isset($options[OssConst::OSS_HEADERS][OssConst::OSS_ACL]) && !empty($options[OssConst::OSS_HEADERS][OssConst::OSS_ACL])) {
            if (!in_array(strtolower($options[OssConst::OSS_HEADERS][OssConst::OSS_ACL]), OssConst::$OSS_ACL_TYPES)) {
                throw new OssException($options[OssConst::OSS_HEADERS][OssConst::OSS_ACL] . ':' . 'acl is invalid(private,public-read,public-read-write)');
            }
        }
    }

    /**
     * 校验bucket,options参数
     *
     * @param string $bucket
     * @param string $object
     * @param array  $options
     * @param bool   $isCheckObject
     * @throws OssException
     */
    private function preCheckCommon($bucket, $object, &$options, $isCheckObject = true)
    {
        if ($isCheckObject) {
            $this->preCheckObject($object);
        }
        $this->preCheckOptions($options);
        $this->preCheckBucket($bucket);
    }

    /**
     * checks parameters
     *
     * @param array  $options
     * @param string $param
     * @param string $funcName
     * @throws OssException
     */
    private function preCheckParam($options, $param, $funcName)
    {
        if (!isset($options[$param])) {
            throw new OssException('The `' . $param . '` options is required in ' . $funcName . '().');
        }
    }

    /**
     * Checks md5
     *
     * @param array $options
     * @return bool|null
     */
    private function isCheckMD5($options)
    {
        return $this->getValue($options, OssConst::OSS_CHECK_MD5, false, true, true);
    }

    /**
     * Gets value of the specified key from the options
     *
     * @param array  $options
     * @param string $key
     * @param string $default
     * @param bool   $isCheckEmpty
     * @param bool   $isCheckBool
     * @return bool|null
     */
    private function getValue($options, $key, $default = NULL, $isCheckEmpty = false, $isCheckBool = false)
    {
        $value = $default;
        if (isset($options[$key])) {
            if ($isCheckEmpty) {
                if (!empty($options[$key])) {
                    $value = $options[$key];
                }
            } else {
                $value = $options[$key];
            }
            unset($options[$key]);
        }
        if ($isCheckBool) {
            if ($value !== true && $value !== false) {
                $value = false;
            }
        }
        return $value;
    }

    /**
     * Gets mimetype
     *
     * @param string $object
     * @return string
     */
    private function getMimeType($object, $file = null)
    {
        if (!is_null($file)) {
            $type = MimeTypes::getMimetype($file);
            if (!is_null($type)) {
                return $type;
            }
        }

        $type = MimeTypes::getMimetype($object);
        if (!is_null($type)) {
            return $type;
        }

        return OssConst::DEFAULT_CONTENT_TYPE;
    }

    /**
     * 校验object参数
     *
     * @param string $object
     * @throws OssException
     */
    private function preCheckObject($object)
    {
        OssUtil::throwOssExceptionWithMessageIfEmpty($object, "object name is empty");
    }

    /**
     * 检测options参数
     *
     * @param array $options
     * @throws OssException
     */
    private function preCheckOptions(&$options)
    {
        OssUtil::validateOptions($options);
        if (!$options) {
            $options = array();
        }
    }

    /**
     * 校验option restore
     *
     * @param string $restore
     * @throws OssException
     */
    private function preCheckStorage($storage)
    {
        if (is_string($storage)) {
            switch ($storage) {
                case OssConst::OSS_STORAGE_ARCHIVE:
                    return;
                case OssConst::OSS_STORAGE_IA:
                    return;
                case OssConst::OSS_STORAGE_STANDARD:
                    return;
                case OssConst::OSS_STORAGE_COLDARCHIVE:
                    return;
                default:
                    break;
            }
        }
        throw new OssException('storage name is invalid');
    }

    /**
     * 校验bucket参数
     *
     * @param string $bucket
     * @param string $errMsg
     * @throws OssException
     */
    private function preCheckBucket($bucket, $errMsg = 'bucket is not allowed empty')
    {
        OssUtil::throwOssExceptionWithMessageIfEmpty($bucket, $errMsg);
    }

    ###############################参数验证#########################################

    ###############################请求组装#########################################

    /**
     * 获得当次请求使用的域名
     * bucket在前的三级域名，或者二级域名，如果是cname或者ip的话，则是二级域名
     *
     * @param $bucket
     * @return string 剥掉协议头的域名
     */
    private function generateHostname($bucket)
    {
        if ($this->hostType === OssConst::OSS_HOST_TYPE_IP) {
            $hostname = $this->hostname;
        } elseif ($this->hostType === OssConst::OSS_HOST_TYPE_CNAME) {
            $hostname = $this->hostname;
        } else {
            // 专有域或者官网endpoint
            $hostname = ($bucket == '') ? $this->hostname : ($bucket . '.') . $this->hostname;
        }
        return $hostname;
    }

    /**
     * 获得当次请求的资源定位字段
     *
     * @param $options
     * @return string 资源定位字段
     */
    private function generateResourceUri($options)
    {
        $resourceUri = "";
        // resource_uri + bucket
        if (isset($options[OssConst::OSS_BUCKET]) && '' !== $options[OssConst::OSS_BUCKET]) {
            if ($this->hostType === OssConst::OSS_HOST_TYPE_IP) {
                $resourceUri = '/' . $options[OssConst::OSS_BUCKET];
            }
        }
        // resource_uri + object
        if (isset($options[OssConst::OSS_OBJECT]) && '/' !== $options[OssConst::OSS_OBJECT]) {
            $resourceUri .= '/' . str_replace(array('%2F', '%25'), array('/', '%'), rawurlencode($options[OssConst::OSS_OBJECT]));
        }
        // resource_uri + sub_resource
        $conjunction = '?';
        if (isset($options[OssConst::OSS_SUB_RESOURCE])) {
            $resourceUri .= $conjunction . $options[OssConst::OSS_SUB_RESOURCE];
        }
        return $resourceUri;
    }

    /**
     * 生成query_string
     *
     * @param mixed $options
     * @return string
     */
    private function generateQueryString($options)
    {
        $queryStringParams = [];
        //请求参数
        if (isset($options[OssConst::OSS_QUERY_STRING])) {
            $queryStringParams = array_merge($queryStringParams, $options[OssConst::OSS_QUERY_STRING]);
        }
        return OssUtil::toQueryString($queryStringParams);
    }

    private function generateRequestUrl($options, $signableQueryString)
    {
        // 获得当次请求使用的hostname，如果是公共域名或者专有域名，bucket拼在前面构成三级域名
        $hostname = $this->generateHostname($options[OssConst::OSS_BUCKET]);
//        $hostname = "192.168.159.1:1123";
        //资源地址生成
        $resourceUri = $this->generateResourceUri($options);
        //请求地址转换生成
        $queryString = $this->generateQueryString($options);

        //生成请求URL
        $conjunction = '?';
        $nonSignableResource = '';
        if (isset($options[OssConst::OSS_SUB_RESOURCE])) {
            $conjunction = '&';
        }
        if ($signableQueryString !== '') {
            $signableQueryString = $conjunction . $signableQueryString;
            $conjunction = '&';
        }
        if ($queryString !== '') {
            $nonSignableResource .= $conjunction . $queryString;
            $conjunction = '&';
        }

        // 获得当次请求使用的协议头，是https还是http
        $scheme = $this->useSSL ? 'https://' : 'http://';
        //请求地址
        $this->requestUrl = $scheme . $hostname . $resourceUri . $signableQueryString . $nonSignableResource;
        return [$conjunction, $signableQueryString];
    }

    /**
     * 生成请求用的UserAgent
     *
     * @return string
     */
    private function generateUserAgent()
    {
        return OssConst::OSS_NAME . "/" . OssConst::OSS_VERSION . " (" . php_uname('s') . "/" . php_uname('r') . "/" . php_uname('m') . ";" . PHP_VERSION . ")";
    }

    /**
     * 设置文件上传流
     * setHttpClientFileStream
     * @param HttpClient $httpClient
     * @param            $options
     * @author Tioncico
     * Time: 9:57
     */
    private function setHttpClientFileStream(HttpClient $httpClient, $options)
    {
//        if (isset($options[OssConst::OSS_SEEK_TO])) {
//            $httpClient->setSeekPosition((integer)$options[OssConst::OSS_SEEK_TO]);
//        }

        if (isset($options[OssConst::OSS_FILE_DOWNLOAD])) {
//            $httpClient->getClient()->download($this->requestUrl ,$options[OssConst::OSS_FILE_DOWNLOAD],$options[OssConst::OSS_SEEK_TO]);
        }

        // Streaming uploads
        if (isset($options[OssConst::OSS_FILE_UPLOAD])) {
            $fileStream = new SplFileStream($options[OssConst::OSS_FILE_UPLOAD]);
            if (isset($options[OssConst::OSS_SEEK_TO])) {
                $fileStream->seek($options[OssConst::OSS_SEEK_TO]);
            }
            $httpClient->getClient()->setData($fileStream->read($options[OssConst::OSS_CONTENT_LENGTH] ?? $fileStream->getSize()));
        }
    }

    /**
     * 设置http客户端的header
     * setHttpClientHeaders
     * @param HttpClient $httpClient
     * @param            $headers
     * @author Tioncico
     * Time: 14:18
     */
    protected function setHttpClientHeaders(HttpClient $httpClient, $headers)
    {
        if (!isset($headers[OssConst::OSS_ACCEPT_ENCODING])) {
//            $headers[OssConst::OSS_ACCEPT_ENCODING] = '';
        }

        uksort($headers, 'strnatcasecmp');
        foreach ($headers as $headerKey => $headerValue) {
            $headerValue = str_replace(array("\r", "\n"), '', $headerValue);
            if ($headerValue !== '' || $headerKey === OssConst::OSS_ACCEPT_ENCODING) {
                $httpClient->setHeader($headerKey, $headerValue, false);
            }
        }
    }

    /**
     * 设置请求方法
     * setHttpClientMethod
     * @param HttpClient $httpClient
     * @param            $options
     * @author Tioncico
     * Time: 16:22
     */
    protected function setHttpClientMethod(HttpClient $httpClient, $options)
    {
        if (isset($options[OssConst::OSS_METHOD])) {
            $httpClient->setMethod($options[OssConst::OSS_METHOD]);
        }
    }

    /**
     * 设置请求的数据
     * setHttpClientData
     * @param HttpClient $httpClient
     * @param            $options
     * @author Tioncico
     * Time: 16:23
     */
    protected function setHttpClientData(HttpClient $httpClient, $options)
    {
        if (isset($options[OssConst::OSS_CONTENT])) {
            $httpClient->getClient()->setData($options[OssConst::OSS_CONTENT]);
        }
    }

    /**
     * 判断是否为auth预检,不实际请求
     * preAuth
     * @param $options
     * @param $signature
     * @param $conjunction
     * @return string|null
     * @author Tioncico
     * Time: 16:28
     */
    protected function preAuth($options, $signature, $conjunction)
    {
        if (isset($options[OssConst::OSS_PREAUTH]) && (integer)$options[OssConst::OSS_PREAUTH] > 0) {
            $signedUrl = $this->requestUrl . $conjunction . OssConst::OSS_URL_ACCESS_KEY_ID . '=' . rawurlencode($this->config->getAccessKeyId()) . '&' . OssConst::OSS_URL_EXPIRES . '=' . $options[OssConst::OSS_PREAUTH] . '&' . OssConst::OSS_URL_SIGNATURE . '=' . rawurlencode($signature);
            return $signedUrl;
        } elseif (isset($options[OssConst::OSS_PREAUTH])) {
            return $this->requestUrl;
        } else {
            return null;
        }
    }

    ###############################请求组装#########################################

    /**
     * downFile
     * @param Response $response
     * @param          $options
     * @author Tioncico
     * Time: 13:57
     */
    protected function downFile(Response $response, $options)
    {
        //如果是下载文件,则保存
        if (isset($options[OssConst::OSS_FILE_DOWNLOAD])) {
            $file = new SplFileStream($options[OssConst::OSS_FILE_DOWNLOAD]);
            if (isset($options[OssConst::OSS_SEEK_TO])) {
                $file->truncate((int)$options[OssConst::OSS_SEEK_TO]);
            }
            $file->write($response->getBody());
        }
    }


}
