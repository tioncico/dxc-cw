<?php


namespace App\WebSocket\Cache;


use App\Utility\RedisClient;
use EasySwoole\Component\Singleton;

class UserFdMap
{
    use Singleton;

    const TTL = 86400 * 1;

    /**
     * 绑定fd<->userId
     * bind
     * @param $fd
     * @param $userId
     * @throws \Throwable
     * @author tioncico
     * Time: 11:28 上午
     */
    public function bind($fd, $userId)
    {
        $this->setFdUser($fd, $userId);
        $this->setUserFd($userId, $fd);
    }

    /**
     * fd断线
     * fdClose
     * @param int $fd
     * @throws \Throwable
     * @author tioncico
     * Time: 11:29 上午
     */
    public function fdClose(int $fd)
    {
        $userId = $this->getFdUserId($fd);
        $this->delFdUser($fd);
        if (!empty($userId)) {
            $this->delUserFd($userId, $fd);
        }
    }

    /**
     * 根据fd获取userId
     * getFdUserId
     * @param int $fd
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:29 上午
     */
    public function getFdUserId(int $fd)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($fd) {
            $result =  $redisClient->hGet($this->getFdUserKey(), $fd);
            //设置一个过期时间
            $redisClient->expire($this->getFdUserKey(), time() + self::TTL);
            return $result;
        });
    }

    /**
     * 根据userId获取fd
     * getUserFdList
     * @param int $userId
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:29 上午
     */
    public function getUserFdList(int $userId)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId) {
            $result =  $redisClient->hGetAll($this->getUserFdKey($userId));
            //设置一个过期时间
            $redisClient->expire($this->getUserFdKey($userId), time() + self::TTL);
            return $result;
        });
    }

    /**
     * 设置userId->fd
     * setUserFd
     * @param int $userId
     * @param int $fd
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:29 上午
     */
    public function setUserFd(int $userId, int $fd)
    {
        //一个userId,可能有多个fd,所以使用hash 存储方案
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $fd) {
            $result = $redisClient->hSet($this->getUserFdKey($userId), $fd, 1);
            //设置一个过期时间
            $redisClient->expire($this->getUserFdKey($userId), time() + self::TTL);
            return $result;
        });
    }

    /**
     * 设置fd->userId
     * setFdUser
     * @param int $fd
     * @param int $userId
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:30 上午
     */
    public function setFdUser(int $fd, int $userId)
    {
        //一个fd,只有一个userId
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $fd) {
            $result = $redisClient->hSet($this->getFdUserKey(), $fd, $userId);
            //设置一个过期时间
            $redisClient->expire($this->getFdUserKey(), time() + self::TTL);
            return $result;
        });
    }

    /**
     * 删除fd->userId绑定
     * delFdUser
     * @param int $fd
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:30 上午
     */
    public function delFdUser(int $fd)
    {
        //一个fd,只有一个userId
        return RedisClient::invoke(function (RedisClient $redisClient) use ($fd) {
            return $redisClient->hDel($this->getFdUserKey(), $fd);
        });
    }

    /**
     * 删除userId->fd绑定
     * delUserFd
     * @param int $userId
     * @param int $fd
     * @return false|mixed|null
     * @throws \Throwable
     * @author tioncico
     * Time: 11:30 上午
     */
    public function delUserFd(int $userId, int $fd)
    {
        return RedisClient::invoke(function (RedisClient $redisClient) use ($userId, $fd) {
            return $redisClient->hDel($this->getUserFdKey($userId), $fd);
        });
    }

    protected function getUserFdKey($userId)
    {
        return "ws_user_fd_{$userId}";
    }

    protected function getFdUserKey()
    {
        return "ws_fd_user";
    }

    public function clear(){
        return RedisClient::invoke(function (RedisClient $redisClient) {
            $redisClient->del($this->getFdUserKey());
            $cursor = 0;
            do {
                //每次迭代都会设置一次$cursor,为0代表迭代完成
                $keys = $redisClient->scan($cursor, 'ws_user_fd_*', 1000);
                $redisClient->del(...$keys);
            } while ($cursor);
        });
    }
}
