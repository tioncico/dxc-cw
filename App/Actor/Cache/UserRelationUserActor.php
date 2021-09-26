<?php


namespace App\Actor\Cache;


use App\Utility\RedisClient;
use EasySwoole\Component\Singleton;

class UserRelationUserActor
{
    use Singleton;

    const KEY = 'userRelationUserActor';

    public function addUserActor($userId,$actorId){
        //一个userId,可能有多个fd,所以使用hash 存储方案
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $actorId) {
            $result = $redisClient->hSet(self::KEY, $userId,$actorId);
            return $result;
        });
    }
    public function delUserActor($userId){
        //一个userId,可能有多个fd,所以使用hash 存储方案
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $result = $redisClient->hDel(self::KEY, $userId);
            return $result;
        });
    }

    public function getUserActor($userId){
        //一个userId,可能有多个fd,所以使用hash 存储方案
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $result = $redisClient->hGet(self::KEY, $userId);
            return $result;
        });
    }

    public function clear(){
        return RedisClient::invoke(function (RedisClient $redisClient) {
            $redisClient->del(self::KEY);
        });
    }
}
