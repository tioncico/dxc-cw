<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * UserBackpackModel
 * Class UserBackpackModel
 * Create With ClassGeneration
 * @property int    $backpackId // 背包id
 * @property int    $userId // 用户id
 * @property int    $goodsId // 物品id
 * @property string $goodsCode // 物品code
 * @property int    $num // 数量
 * @property int    $goodsType // 物品类型
 */
class UserBackpackModel extends BaseModel
{
    protected $tableName = 'user_backpack_list';

    const GOLD_CODE = 'gold';
    const MONEY_CODE = 'money';


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

    public function getUseGoldInfo($userId)
    {
        $info = $this->getInfoByCode($userId, self::GOLD_CODE);
        if (empty($info)) {
            $goldGoodsInfo = GoodsModel::create()->get(['code' => self::GOLD_CODE]);

            $info = $this->addData($userId, $goldGoodsInfo, 0);
        }
        return $info;
    }

    public function getUseMoneyInfo($userId)
    {
        $info = $this->getInfoByCode($userId, self::MONEY_CODE);
        if (empty($info)) {
            $goldGoodsInfo = GoodsModel::create()->get(['code' => self::MONEY_CODE]);

            $info = $this->addData($userId, $goldGoodsInfo, 0);
        }
        return $info;
    }

    public function getInfoByCode($userId, $code)
    {
        $info = $this->get(['userId' => $userId, 'goodsCode' => $code]);
        return $info;
    }

    public function addData($userId, GoodsModel $goodsInfo, $num = 0)
    {
        $model = new UserBackpackModel();
        $data = [
            'userId'    => $userId,
            'goodsId'   => $goodsInfo->goodsId,
            'goodsCode' => $goodsInfo->code,
            'num'       => $num,
            'goodsType' => $goodsInfo->type,
        ];
        $model->data($data)->save();
        return $model;
    }

    public function goodsInfo()
    {
        return $this->hasOne(GoodsModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'goodsCode', 'code');
    }

    public function strengthenInfo()
    {
        return $this->hasOne(UserGoodsEquipmentStrengthenAttributeModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'backpackId', 'userEquipmentBackpackId');
    }

    public function userEquipmentInfo()
    {
        return $this->hasOne(UserEquipmentBackpackModel::class, function (QueryBuilder $query) {
            $query->fields(['backpackId', 'isUse', 'strengthenLevel', 'attributeDescription', 'attributeEntryDescription', 'extraAttributeDescription', 'suitAttribute2Description', 'suitAttribute3Description', 'suitAttribute5Description', 'equipmentType', 'suitCode', 'rarityLevel', 'level',
            ]);
            return $query;
        }, 'backpackId', 'backpackId');
    }

}

