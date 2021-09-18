<?php


namespace App\Service\Game;


use App\Model\Game\GoodsModel;
use App\Model\Game\UserBackpackModel;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\Str;

class UseGoodsService
{
    use Singleton;
    public function useGoods(UserBackpackModel $userBackpackInfo){
        $code = $userBackpackInfo->goodsCode;
        $methodName = 'use' . Str::studly($code);

    }

    /**
     * 使用礼包
     * useGift
     * @author tioncico
     * Time: 4:09 下午
     */
    protected function useGift(){



    }

    /**
     * 使用宠物蛋
     * usePetEgg
     * @author tioncico
     * Time: 4:10 下午
     */
    protected function usePetEgg(UserBackpackModel $userBackpackInfo){
        //获取宠物蛋详情
//        $goodsInfo = GoodsModel::create()->get()


    }

}
