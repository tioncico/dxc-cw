<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * ShopGoodsModel
 * Class ShopGoodsModel
 * Create With ClassGeneration
 * @property int    $shopGoodsId // 商品id
 * @property string $goodsCode // 物品code
 * @property string $goodsName // 物品名
 * @property int    $limit // 永久购买限制
 * @property int    $limitType // 限制类型 0永久,1每日,2每周,3每月
 * @property int    $price // 售价
 * @property int    $stock // 库存,0表示没有库存
 * @property int    $priceType // 售价类型 1金币,2钻石
 * @property int    $addTime // 新增时间
 */
class ShopGoodsModel extends BaseModel
{
    protected $tableName = 'shop_goods_list';


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

    public function addData(GoodsModel $goodsModel, $price, $priceType = 1)
    {

        $data = [
            'goodsCode' => $goodsModel->code,
            'goodsName' => $goodsModel->name,
            'limit'     => 0,
            'limitType' => 0,
            'price'     => $price,
            'stock'     => 0,
            'priceType' => $priceType,
            'addTime'   => time(),
        ];
        $model = new ShopGoodsModel($data);
        $model->save();
        return $model;
    }

    public function todayBuyInfo($userId = -1)
    {
        if ($userId < 0) {
            return null;
        }
        return $this->hasOne(UserBuyShopGoodsOrderModel::class, function (QueryBuilder $query) {
            $query->where("date", date('Ymd'));
            $query->fields("sum(num) as num,shopGoodsId");
            $query->groupBy('shopGoodsId');
            return $query;
        }, 'shopGoodsIdByToday', 'shopGoodsId');
    }

    public function byInfoIn7Day($userId = -1)
    {
        if ($userId < 0) {
            return null;
        }
        return $this->hasOne(UserBuyShopGoodsOrderModel::class, function (QueryBuilder $query) {
            $beginWeek = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));
            $query->where("date", date('Ymd', $beginWeek), '>=');
            $query->groupBy('shopGoodsId');
            $query->fields("sum(num) as num,shopGoodsId");
            return $query;
        }, 'shopGoodsIdBy7Day', 'shopGoodsId');
    }

    public function byInfoIn30Day($userId = -1)
    {
        if ($userId < 0) {
            return null;
        }
        return $this->hasOne(UserBuyShopGoodsOrderModel::class, function (QueryBuilder $query) {
            $beginThisMonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $query->where("date", date('Ymd', $beginThisMonth), '>=');
            $query->groupBy('shopGoodsId');
            $query->fields("sum(num) as num,shopGoodsId");
            return $query;
        }, 'shopGoodsIdBy30Day', 'shopGoodsId');
    }

    public function goodsInfo()
    {
        return $this->hasOne(GoodsModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'goodsCode', 'code');
    }
}

