<?php


namespace App\Service\Game\Cdk;


use App\Model\BaseModel;
use App\Model\Game\Cdk\GameCdkGoodsModel;
use App\Model\Game\Cdk\GameCdkModel;
use App\Model\Game\Cdk\UserCdkReceiveModel;
use App\Model\Game\GoodsModel;
use App\Service\Game\BackpackService;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Singleton;

class CdkService
{
    use Singleton;

    public function addSdk($goodsList, $num = 1)
    {
        return BaseModel::transaction(function () use ($goodsList, $num) {
            $model = new GameCdkModel();
            $cdkInfo = $model->addData($num);
            foreach ($goodsList as $value) {
                $num = $value['num'];
                $code = $value['code'];
                GameCdkGoodsModel::create()->addData($cdkInfo->cdkId, $code, $num);
            }
            return $cdkInfo;
        });
    }

    public function useCdk($userId, $cdk)
    {
        BaseModel::transaction(function () use ($userId, $cdk) {
            $cdkInfo = GameCdkModel::create()->lockForUpdate()->getInfoByCdk($cdk);
            Assert::assert(!!$cdkInfo, "cdk不存在或已使用");
            Assert::assert($cdkInfo->status == 0, 'cdk不存在或已使用');
            Assert::assert($cdkInfo->num > 0, 'cdk不存在或已使用');
            $userCdkInfo = UserCdkReceiveModel::create()->getInfo($userId, $cdkInfo->cdkId);
            Assert::assert(empty($userCdkInfo), "cdk不存在或已使用");
            $goodsList = GameCdkGoodsModel::create()->where('cdkId', $cdkInfo->cdkId)->all();
            /**
             * @var GameCdkGoodsModel $goodsModel
             */
            foreach ($goodsList as $goodsModel) {
                BackpackService::getInstance()->addGoods($userId, GoodsModel::create()->getInfoByCode($goodsModel->goodsCode), $goodsModel->goodsNum);
            }
            //创建使用记录
            UserCdkReceiveModel::create()->addData($userId, $cdkInfo->cdkId);
            //数量-1
            $cdkInfo->num--;
            $update = ['num' => $cdkInfo->num];
            if ($cdkInfo->num <= 0) {
                $update['status'] = 1;
            }
            $cdkInfo->update($update);
        });
    }

}
