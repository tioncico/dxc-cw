<?php


namespace App\Utility;

use App\Actor\Cache\UserRelationMap;
use App\Actor\Cache\UserRelationUserActor;
use App\Actor\Command;
use App\Actor\MapActor;
use App\Actor\UserActor;
use App\Utility\Cache\UserLastRequestCache;
use App\WebSocket\Cache\UserFdMap;
use App\WebSocket\Event;
use EasySwoole\Actor\Actor;
use EasySwoole\Component\Di;
use EasySwoole\Component\Process\Manager;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Config as GlobalConfig;
use EasySwoole\EasySwoole\Crontab\Crontab;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\SysConst;
use EasySwoole\Http\Message\Status;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\ORM\Db\Config;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\DbManager;
use EasySwoole\Redis\Config\RedisConfig;
use EasySwoole\RedisPool\RedisPool;
use EasySwoole\Socket\Client\WebSocket;
use Swoole\Timer;
use Swoole\Coroutine\Scheduler;

class GlobalEvent
{
    use Singleton;

    public function initialize()
    {
        $this->mysqlInit();
        $this->redisInit();

        //需要用到数据库的同步
        $scheduler = new Scheduler();
        $scheduler->add(function () {
            //注意,这3行代码只能放到最后面执行
            //删除关联对象
            UserFdMap::getInstance()->clear();
            //删除mapActor对象
            UserRelationMap::getInstance()->clear();
//            UserRelationUserActor::getInstance()->clear();

            Timer::clearAll();
            DbManager::getInstance()->getConnection()->__getClientPool()->reset();
            RedisPool::getInstance()->getPool(RedisClient::REDIS_POOL_NAME)->reset();
        });
        //如果是测试的话，则不用再启动一次
        if (defined('TEST')) {
            return true;
        }
        $scheduler->start();
    }

    public function mainServerCreate(EventRegister $eventRegister)
    {
        //注册全局onrequest事件
        Di::getInstance()->set(SysConst::HTTP_GLOBAL_ON_REQUEST,function (Request $request,Response $response){
            //跨域头
            if ($this->crossDomainResponse($request,$response)===false){
                return false;
            }
        });
        Event::websocketInit($eventRegister);

        // 注册Actor管理器
        $server = \EasySwoole\EasySwoole\ServerManager::getInstance()->getSwooleServer();
        Actor::getInstance()->register(MapActor::class);
        Actor::getInstance()->setTempDir(EASYSWOOLE_TEMP_DIR)->setListenAddress('0.0.0.0')->setListenPort('9900')->attachServer($server);

        //定时任务
        $tick = new TickProcess();

        $tick->addTask(5*60, function () {
            //5分钟玩家不活跃,则删除actor
//            UserLastRequestCache::getInstance()->chunkUserExpire(function ($userId){
//                $actorId = UserRelationUserActor::getInstance()->getUserActor($userId);
//                if ($actorId){
//                    UserActor::client()->exit($actorId);
//                }
//                UserRelationUserActor::getInstance()->delUserActor($userId);
//            },5*60);
        });
        Manager::getInstance()->addProcess($tick);
    }

    /**
     * 跨域头
     * crossDomainResponse
     * @param Request  $request
     * @param Response $response
     * @return bool
     * @author tioncico
     * Time: 10:37 上午
     */
    protected function crossDomainResponse(Request $request,Response $response){
        $response->withHeader('Access-Control-Allow-Origin', '*');
        $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->withHeader('Access-Control-Allow-Credentials', 'true');
        $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        if ($request->getMethod() === 'OPTIONS') {
            $response->withStatus(Status::CODE_OK);
            return false;
        }
        return true;
    }

    /**
     * mysql连接池初始化
     * mysqlInit
     * @throws \EasySwoole\Pool\Exception\Exception
     * @author tioncico
     * Time: 10:41 上午
     */
    public function mysqlInit(){
        //注册mysql
        $config = new Config(GlobalConfig::getInstance()->getConf('MYSQL'));
        //连接池配置
        $config->setGetObjectTimeout(3.0); //设置获取连接池对象超时时间
        $config->setIntervalCheckTime(15*1000); //设置检测连接存活执行回收和创建的周期
        $config->setMaxIdleTime(10); //连接池对象最大闲置时间(秒)
        $config->setMaxObjectNum(20); //设置最大连接池存在连接对象数量
        $config->setMinObjectNum(5); //设置最小连接池存在连接对象数量
        $config->setAutoPing(5); //设置自动ping客户端链接的间隔
        DbManager::getInstance()->addConnection(new Connection($config));

    }

    /**
     * redis 连接池初始化
     * redisInit
     * @throws \EasySwoole\Pool\Exception\Exception
     * @throws \EasySwoole\RedisPool\Exception\Exception
     * @throws \EasySwoole\RedisPool\RedisPoolException
     * @author tioncico
     * Time: 10:41 上午
     */
    public function redisInit(){
        //注册redis
        $config = new RedisConfig(GlobalConfig::getInstance()->getConf('REDIS'));
        $redisPoolConfig = RedisPool::getInstance()->register( $config, RedisClient::REDIS_POOL_NAME,RedisClient::class);
        $redisPoolConfig->setMaxObjectNum(40);
    }

}
