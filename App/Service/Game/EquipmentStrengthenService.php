<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentAttributeEntryModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserGoodsEquipmentAttributeEntryModel;
use App\Model\Game\UserGoodsEquipmentStrengthenAttributeModel;
use App\Service\BaseService;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;
use EasySwoole\Component\Singleton;

class EquipmentStrengthenService extends BaseService
{
    use Singleton;

    /**
     * 获取强化数据
     * getStrengthenData
     * @param UserEquipmentBackpackModel $userEquipmentBackpackModel
     * @param UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo
     * @return UserGoodsEquipmentStrengthenAttributeModel|array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|null
     * @throws \EasySwoole\ORM\Exception\Exception
     * @author tioncico
     * Time: 4:03 下午
     */
    public function getStrengthenData(UserEquipmentBackpackModel $userEquipmentBackpackModel,UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo)
    {
        $strengthenInfo = clone $strengthenInfo;
        //获取当前装备的强化数据
        $strengthenInfo->strengthenLevel += 1;
        //武器强化公式为 强化攻击力= 装备稀有度*装备等级*强化等级
        //防具强化公式为 强化防御力= 装备稀有度*0.2*装备等级*0.8*强化等级
        //首饰强化公式为 强化血量= 装备稀有度*1*装备等级*10*强化等级
        if (in_array($userEquipmentBackpackModel->equipmentType, [1])) {
            //武器
            $strengthenInfo->attack = $userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel);
        }
        if (in_array($userEquipmentBackpackModel->equipmentType, [2, 3, 4, 5, 6])) {
            //防具
            $strengthenInfo->defense = $userEquipmentBackpackModel->rarityLevel * 0.2 * $userEquipmentBackpackModel->level * 0.8 * ($strengthenInfo->strengthenLevel);
        }
        if (in_array($userEquipmentBackpackModel->equipmentType, [8, 9])) {
            //称号
            $strengthenInfo->hp = $userEquipmentBackpackModel->rarityLevel * 1 * $userEquipmentBackpackModel->level * 10 * ($strengthenInfo->strengthenLevel);
        }
        return $strengthenInfo;
    }

    /**
     * 获取强化所需消耗
     * getStrengthenConsumable
     * @param UserEquipmentBackpackModel                 $userEquipmentBackpackModel
     * @param UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo
     * @return float[]|int[]
     * @author tioncico
     * Time: 4:15 下午
     */
    public function getStrengthenConsumable(UserEquipmentBackpackModel $userEquipmentBackpackModel, UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo)
    {
        //需要金币 装备稀有度*装备等级*强化等级*1000
        $goldNum = $userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel) * 1000;
        //需要装备碎片数量 装备稀有度*装备等级*强化等级*5
        $materialNum = $userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel) * 5;

        $goldInfo = GoodsModel::create()->field('goods_list.*,user_backpack_list.num')->join('user_backpack_list','user_backpack_list.goodsCode = goods_list.code')->getInfoByCode('gold');
        $materialInfo = GoodsModel::create()->field('goods_list.*,user_backpack_list.num')->join('user_backpack_list','user_backpack_list.goodsCode = goods_list.code')->getInfoByCode('material00001');
        $goldInfo['num'] = $goldNum;
        $materialInfo['num'] = $goldNum;
        return [
            $goldInfo,
            $materialInfo
        ];
    }

}
