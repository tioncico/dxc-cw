<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * UserBuyShopGoodsOrderModel
 * Class UserBuyShopGoodsOrderModel
 * Create With ClassGeneration
 * @property int $orderId // 订单id
 * @property int $userId // 用户id
 * @property int $shopGoodsId // 商品id
 * @property int $num // 购买数量
 * @property int $date // 购买日期
 * @property int $addTime // 新增时间
 */
class UserBuyShopGoodsOrderModel extends BaseModel
{
    protected $tableName = 'user_buy_shop_goods_order_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): array
    {
        $list = $this
            ->withTotalCount()
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->page($page, $pageSize)
            ->all();
        $total = $this->lastQueryResult()->getTotalCount();
        $data = [
            'page'      => $page,
            'pageSize'  => $pageSize,
            'list'      => $list,
            'total'     => $total,
            'pageCount' => ceil($total / $pageSize)
        ];
        return $data;
    }

    public function addData($userId, $date, $shopGoodsId, $num = 0)
    {
        $data = [
            'userId'      => $userId,
            'shopGoodsId' => $shopGoodsId,
            'num'         => $num,
            'date'        => $date,
            'addTime'     => time(),
        ];
        $model = new UserBuyShopGoodsOrderModel($data);
        $model->save();
        return $model;
    }

    public function getDateInfo($userId, $date, $shopGoodsId)
    {
        $info = $this->where('userId', $userId)->where('shopGoodsId', $shopGoodsId)->where('date', $date)->get();
        if (empty($info)) {
            $info = $this->addData($userId, $date, $shopGoodsId);
        }
        return $info;
    }
    public function addBuyNum($userId, $shopGoodsId,$num){
        $info = $this->getDateInfo($userId,date('Ymd'),$shopGoodsId);
        $info->update([
            'num'=>QueryBuilder::inc($num)
        ]);
        return $info;
    }
}

