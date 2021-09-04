<?php


namespace App\Service\Game\Fight;


use App\Model\BaseModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Service\Game\BackpackService;
use App\Service\Game\UserService;

class Reward
{
    protected $mapInfo;
    protected $userAttributeInfo;
    protected $userId;
    protected $mapMonsterInfo;

    protected $gold;
    protected $exp;
    protected $goodsList;

    public function __construct($userId,UserAttributeModel $userAttributeInfo, MapModel $mapInfo, MapMonsterModel $monsterInfo)
    {
        $this->userId = $userId;
        $this->userAttributeInfo = $userAttributeInfo;
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
        $this->goodsList =[];
        return [];
    }

    /**
     * 进入数据库
     * addUserData
     * @throws \Throwable
     * @author tioncico
     * Time: 3:51 下午
     */
    public function addUserData(){
        BaseModel::transaction(function (){
            //增加经验
            UserService::getInstance()->userAddExp($this->userId,$this->exp);
            //增加金币
            BackpackService::getInstance()->addGold($this->userId,$this->gold);
        });
    }

    protected function expCount()
    {
        $monsterInfo = $this->mapMonsterInfo;
        $mapInfo = $this->mapInfo;
        $userAttributeInfo = $this->userAttributeInfo;
        $mapExp = $mapInfo->exp;
        if ($monsterInfo->type == 1) {
            //经验 = 地图经验基数*(0.8至1.5)
            $exp = mt_rand(intval($mapExp * 0.8), intval($mapExp * 1.5));

        }
        if ($monsterInfo->type == 2) {
            //经验 = 地图经验基数*(2至3.5)
            $exp = mt_rand(intval($mapExp * 2), intval($mapExp * 3.5));

        }
        if ($monsterInfo->type == 3) {
            //经验 = 地图经验基数*怪物类型(10至20)
            $exp = mt_rand(intval($mapExp * 10), intval($mapExp * 20));
        }
        $this->exp = $exp;
        return $exp;
    }

    protected function goldCount()
    {
        $monsterInfo = $this->mapMonsterInfo;
        $mapInfo = $this->mapInfo;
        $userAttributeInfo = $this->userAttributeInfo;
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
