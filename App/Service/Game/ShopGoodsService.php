<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\PetModel;
use App\Model\Game\ShopGoodsModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserBuyShopGoodsOrderModel;
use App\Service\GameResponse;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;

class ShopGoodsService
{
    use Singleton;

    public function buyGoods($userId, ShopGoodsModel $shopGoodsModel, int $num)
    {
        return BaseModel::transaction(function () use ($userId, $shopGoodsModel, $num) {
            //扣除金币或者钻石
            $price = $shopGoodsModel->price * $num;
            if ($shopGoodsModel->priceType == 1) {
                BackpackService::getInstance()->decGoods($userId, GoodsModel::create()->getInfoByCode('gold'), $price);
            } else {
                BackpackService::getInstance()->decGoods($userId, GoodsModel::create()->getInfoByCode('money'), $price);
            }
            //新增物品
            $goodsInfo = GoodsModel::create()->getInfoByCode($shopGoodsModel->goodsCode);
            BackpackService::getInstance()->addGoods($userId, $goodsInfo, $num);
            //新增购买订单
            UserBuyShopGoodsOrderModel::create()->addBuyNum($userId,$shopGoodsModel->shopGoodsId,$num);
        });
    }

}
