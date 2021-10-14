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
     * @param UserEquipmentBackpackModel                 $userEquipmentBackpackModel
     * @param UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo
     * @return UserGoodsEquipmentStrengthenAttributeModel|array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|null
     * @throws \EasySwoole\ORM\Exception\Exception
     * @author tioncico
     * Time: 4:03 下午
     */
    public function getStrengthenData(UserEquipmentBackpackModel $userEquipmentBackpackModel, UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo)
    {
        $strengthenInfo = clone $strengthenInfo;
        //获取当前装备的强化数据
        $strengthenInfo->strengthenLevel += 1;
        //武器强化公式为 强化攻击力= 装备稀有度*装备等级*强化等级
        //防具强化公式为 强化防御力= 装备稀有度*0.2*装备等级*0.5*强化等级
        //首饰强化公式为 强化血量= 装备稀有度*1*装备等级*10*强化等级
        if (in_array($userEquipmentBackpackModel->equipmentType, [1])) {
            //武器
            $strengthenInfo->attack = intval($userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel));
        }
        if (in_array($userEquipmentBackpackModel->equipmentType, [2, 3, 4, 5, 6])) {
            //防具
            $strengthenInfo->defense = intval($userEquipmentBackpackModel->rarityLevel * 1 * $userEquipmentBackpackModel->level * 0.5 * ($strengthenInfo->strengthenLevel));
        }
        if (in_array($userEquipmentBackpackModel->equipmentType, [8, 9])) {
            //称号
            $strengthenInfo->hp = intval($userEquipmentBackpackModel->rarityLevel * 1 * $userEquipmentBackpackModel->level * 10 * ($strengthenInfo->strengthenLevel));
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
    public function getStrengthenConsumable(UserEquipmentBackpackModel $userEquipmentBackpackModel, UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo): array
    {
        //需要金币 装备稀有度*装备等级*强化等级*1000
        $goldNum = $userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel) * 1000;
        //需要装备碎片数量 装备稀有度*装备等级*强化等级*5
        $materialNum = $userEquipmentBackpackModel->rarityLevel * $userEquipmentBackpackModel->level * ($strengthenInfo->strengthenLevel) * 5;

        $goldInfo = GoodsModel::create()->field('goods_list.*,if(user_backpack_list.num is null,0,user_backpack_list.num) as nowNum')->join('user_backpack_list', 'user_backpack_list.goodsCode = goods_list.code and user_backpack_list.userId = '.$userEquipmentBackpackModel->userId, 'left')->getInfoByCode('gold');
        $materialInfo = GoodsModel::create()->field('goods_list.*,if(user_backpack_list.num is null,0,user_backpack_list.num) as nowNum')->join('user_backpack_list', 'user_backpack_list.goodsCode = goods_list.code and user_backpack_list.userId = '.$userEquipmentBackpackModel->userId, 'left')->getInfoByCode('material00001');
//        $goldInfo = $goldInfo->toArray(null,false);
//        $materialInfo = $materialInfo->toArray(null,false);
        $goldInfo['num'] = $goldNum;
        $materialInfo['num'] = $materialNum;
        return [
            $goldInfo,
            $materialInfo
        ];
    }

    /**
     * 强化装备
     * strengthenEquipment
     * @param UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo
     * @author tioncico
     * Time: 7:22 下午
     */
    public function strengthenEquipment(UserGoodsEquipmentStrengthenAttributeModel $strengthenInfo):?UserGoodsEquipmentStrengthenAttributeModel
    {
        //强化概率
        $arr = [1=>10000,2 => 10000, 3 => 9000, 4 => 8000, 5 => 7000, 6 => 6000, 7 => 5000, 8 => 4000, 9 => 3000, 10 => 2000, 11 => 1000, 12 => 900, 13 => 800, 14 => 700, 16 => 600, 17 => 500, 18 => 400, 19 => 300, 20 => 200, 21 => 100, 22 => 90, 23 => 80, 24 => 70, 25 => 60, 26 => 50, 27 => 40, 28 => 30, 29 => 20, 30 => 10, 31 => 9, 32 => 8,];
        $randRate = $arr[$strengthenInfo->strengthenLevel];
        $randNum = mt_rand(1, 10000);
        if ($randNum > $randRate) {
            return null;
        }
        $strengthenInfo->update();
        return  $strengthenInfo;
    }

}
