<?php


namespace App\Utility\Cache;


use App\Utility\RedisClient;
use EasySwoole\Component\Singleton;

class UserLastRequestCache
{
    use Singleton;
    const KEY='UserLastRequestCache';

    public function updateTime($userId){
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
           return $redisClient->zAdd(self::KEY,time(),$userId);
        });
    }

    public function chunkUserExpire(callable $callable,int $ttl=60*1){
        RedisClient::invoke(function (RedisClient $redisClient) use ($callable,$ttl) {
            $list = $redisClient->zRangeByScore(self::KEY,0,time()-$ttl, ['limit' => array(0, 1000)]);
            foreach ($list as $userId){
                call_user_func($callable,$userId);
                $redisClient->zRem(self::KEY,$userId);
            }
        });
    }
}
