<?php


namespace App\Service\Game\Fight;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapGoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Service\Game\BackpackService;
use App\Service\Game\UserService;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;

class Reward
{
    protected $mapInfo;
    protected $userId;
    protected $mapMonsterInfo;

    protected $gold;
    protected $exp;
    protected $goodsList;

    public function __construct($userId, MapModel $mapInfo, MapMonsterModel $monsterInfo)
    {
        $this->userId = $userId;
        $this->mapInfo = $mapInfo;
        $this->mapMonsterInfo = $monsterInfo;
    }

    public function rewardCount()
    {
        return [
            'gold'      => $this->goldCount(),
            'exp'       => $this->expCount(),
            'goodsList' => $this->randGoods()
        ];
    }

    protected function randGoods()
    {
        $goodsList = [];
        $randNum = mt_rand(1, 100);
        if ($randNum <= $this->mapInfo->equipment) {
            $randList = [];
            $common = new Bean();
            $common->setIsCommon(true);
            $common->setValue(-1);
            $randList[] = $common;
            //获取地图可爆稀有装备列表
            $list = MapGoodsModel::create()->where(['mapId' => $this->mapInfo->mapId])->where('goodsType', 7)->all();
            /**
             * @var $list MapGoodsModel[]
             */
            foreach ($list as $key => $value) {
                $randList[] = new Bean([
                    'odds'  => $value->odds,
                    'value' => $key,
                ]);
            }
            /**
             * @var $randValue Bean
             */
            $randValue = (new Rand($randList, 1000))->randOne();
            if ($randValue->getValue() == -1) {
                //随便获取符合该地图等级的传说以下的装备
                $list = GoodsEquipmentModel::create()->where('rarityLevel', 5, '<')->where('level', $this->mapInfo->recommendedLevel + 5, '<=')->where('level', $this->mapInfo->recommendedLevel, '>=')->all();
                /**
                 * @var $goodsEquipmentInfo GoodsEquipmentModel
                 */
                $goodsEquipmentInfo = Rand::randArray($list, 1);
                $goodsInfo = GoodsModel::create()->getInfoByCode($goodsEquipmentInfo->goodsCode);
            } else {
                $goodsInfo = GoodsModel::create()->getInfoByCode($list[$randValue->getValue()]->goodsCode);
            }
            $goodsList[] = ['goodsInfo' => $goodsInfo, 'num' => 1];
        }
        $this->goodsList = $goodsList;
        return $goodsList;
    }

    /**
     * 进入数据库
     * addUserData
     * @throws \Throwable
     * @author tioncico
     * Time: 3:51 下午
     */
    public function addUserData()
    {
        BaseModel::transaction(function () {
            //增加经验
            UserService::getInstance()->userAddExp($this->userId, $this->exp);
            //增加金币
            BackpackService::getInstance()->addGoods($this->userId, GoodsModel::create()->getInfoByCode('gold'), $this->gold);
            foreach ($this->goodsList as $value) {
                BackpackService::getInstance()->addGoods($this->userId, $value['goodsInfo'], $value['num']);
            }
        });
    }

    protected function expCount()
    {
        $monsterInfo = $this->mapMonsterInfo;
        $mapInfo = $this->mapInfo;
        $mapExp = $mapInfo->exp;
        if ($monsterInfo->type == 1) {
            //经验 = 地图经验基数*(0.8至1.5)
            $exp = mt_rand(intval($mapExp * 0.8), intval($mapExp * 1.5));

        }
        if ($monsterInfo->type == 2) {
            //经验 = 地图经验基数*(3至5)
            $exp = mt_rand(intval($mapExp * 3), intval($mapExp * 5));

        }
        if ($monsterInfo->type == 3) {
            //经验 = 地图经验基数*怪物类型(8至10)
            $exp = mt_rand(intval($mapExp * 8), intval($mapExp * 10));
        }
        $this->exp = $exp;
        return $exp;
    }

    protected function goldCount()
    {
        $monsterInfo = $this->mapMonsterInfo;
        $mapInfo = $this->mapInfo;
        $mapGold = $mapInfo->gold;
        if ($monsterInfo->type == 1) {
            //金币 = 地图金币基数*(0.8至1.5)
            $gold = mt_rand(intval($mapGold * 0.8), intval($mapGold * 1.5));

        }
        if ($monsterInfo->type == 2) {
            //金币 = 地图金币基数*(2至3.5)
            $gold = mt_rand(intval($mapGold * 2), intval($mapGold * 3.5));

        }
        if ($monsterInfo->type == 3) {
            //金币 = 地图金币基数*怪物类型(10至20)
            $gold = mt_rand(intval($mapGold * 10), intval($mapGold * 20));
        }
        $this->gold = $gold;
        return $gold;
    }

    /**
     * @return mixed
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * @return mixed
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @return mixed
     */
    public function getGoodsList()
    {
        return $this->goodsList;
    }


}
