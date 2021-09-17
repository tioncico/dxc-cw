<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use function Swoole\Coroutine\Http\request;

/**
 * UserGoodsEquipmentStrengthenAttributeModel
 * Class UserGoodsEquipmentStrengthenAttributeModel
 * Create With ClassGeneration
 * @property int $userEquipmentBackpackId // 用户装备id
 * @property int $strengthenLevel // 强化等级
 * @property int $hp // 血量
 * @property int $attack // 攻击
 * @property int $defense // 防御
 */
class UserGoodsEquipmentStrengthenAttributeModel extends BaseModel
{
    protected $tableName = 'user_goods_equipment_strengthen_attribute_list';


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

    public function addData($userEquipmentBackpackId)
    {
        $model = new self();
        $data = [
            'userEquipmentBackpackId' => $userEquipmentBackpackId,
            'strengthenLevel'         => 1,
            'hp'                      => 0,
            'attack'                  => 0,
            'defense'                 => 0,
        ];
        $model->data($data);
        $model->save();
        return $model;
    }

    public function getData($userEquipmentBackpackId)
    {
        $info = $this->get($userEquipmentBackpackId);
        if (empty($info)) {
            $info = $this->addData($userEquipmentBackpackId);
        }
        return $info;
    }
}

