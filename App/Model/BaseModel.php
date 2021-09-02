<?php

namespace App\Model;

use App\Utility\Bean\ListBean;
use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\DbManager;

/**
 * BaseModel
 * Class BaseModel
 * Create With ClassGeneration
 */
class BaseModel extends AbstractModel
{
    public static function transaction(callable $callable)
    {
        try {
            DbManager::getInstance()->startTransaction();
            $result = $callable();
            DbManager::getInstance()->commit();
            return $result;
        } catch (\Throwable $throwable) {
            DbManager::getInstance()->rollback();
            throw $throwable;
        }
    }

    public function getPageList($page, $pageSize = 20,$isCount=true)
    {
        if ($isCount){
            $this->withTotalCount();
        }
        $list = $this
            ->page($page, $pageSize)
            ->all();
        $listBean = new ListBean();
        $listBean->setList($list);
        $listBean->setPage($page);
        $listBean->setPageSize($pageSize);
        if ($isCount){
            $total = $this->lastQueryResult()->getTotalCount();
            $listBean->setTotal($total);
            $listBean->setPageCount(ceil($total / $pageSize));
        }

        return $listBean;
    }
}


