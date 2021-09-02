<?php


namespace App\Utility;


use EasySwoole\EasySwoole\Logger;
use EasySwoole\Redis\Redis;
use EasySwoole\RedisPool\Redis as RedisPool;

class RedisClient extends Redis
{
    const REDIS_POOL_NAME = 'redis';

    public static function invoke(callable $call)
    {
       try{
          return RedisPool::invoke(static::REDIS_POOL_NAME, $call);
       }catch (\Throwable $throwable){
           throw  $throwable;
       }
    }
}
