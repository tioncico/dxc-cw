<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsEquipmentAttributeEntryModel;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserEquipmentBackpackModel;
use App\Model\Game\UserGoodsEquipmentAttributeEntryModel;
use App\Service\BaseService;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;
use EasySwoole\Component\Singleton;

class EquipmentService extends BaseService
{
    use Singleton;

    public function addUserEquipment($userId, GoodsModel $goodsInfo, GoodsEquipmentModel $equipmentInfo)
    {
        BaseModel::transaction(function () use ($userId, $goodsInfo, $equipmentInfo) {
            //新增装备信息到背包
            $backpackInfo = BackpackService::getInstance()->addGoods($userId, $goodsInfo, 1);
            //新增用户装备信息
            $this->addUserEquipmentBackpack($userId, $backpackInfo, $equipmentInfo);
            //随机用户词条

        });
    }

    public function addUserEquipmentBackpack($userId, $backpackInfo, $equipmentInfo)
    {

        $data = [
            'backpackId'             => $backpackInfo->userId,
            'userId'                 => $userId,
            'isUse'                  => 0,
            'strengthenLevel'        => $equipmentInfo->strengthenLevel,
            'goodsCode'              => $equipmentInfo->goodsCode,
            'goodsName'              => $equipmentInfo->goodsName,
            'equipmentType'          => $equipmentInfo->equipmentType,
            'suitCode'               => $equipmentInfo->suitCode,
            'rarityLevel'            => $equipmentInfo->rarityLevel,
            'level'                  => $equipmentInfo->level,
            'hp'                     => $equipmentInfo->hp,
            'mp'                     => $equipmentInfo->mp,
            'attack'                 => $equipmentInfo->attack,
            'defense'                => $equipmentInfo->defense,
            'endurance'              => $equipmentInfo->endurance,
            'intellect'              => $equipmentInfo->intellect,
            'strength'               => $equipmentInfo->strength,
            'enduranceQualification' => $equipmentInfo->enduranceQualification,
            'intellectQualification' => $equipmentInfo->intellectQualification,
            'strengthQualification'  => $equipmentInfo->strengthQualification,
            'criticalRate'           => $equipmentInfo->criticalRate,
            'criticalStrikeDamage'   => $equipmentInfo->criticalStrikeDamage,
            'hitRate'                => $equipmentInfo->hitRate,
            'dodgeRate'              => $equipmentInfo->dodgeRate,
            'penetrate'              => $equipmentInfo->penetrate,
            'attackSpeed'            => $equipmentInfo->attackSpeed,
            'userElement'            => $equipmentInfo->userElement,
            'attackElement'          => $equipmentInfo->attackElement,
            'jin'                    => $equipmentInfo->jin,
            'mu'                     => $equipmentInfo->mu,
            'tu'                     => $equipmentInfo->tu,
            'sui'                    => $equipmentInfo->sui,
            'huo'                    => $equipmentInfo->huo,
            'light'                  => $equipmentInfo->light,
            'dark'                   => $equipmentInfo->dark,
            'luck'                   => $equipmentInfo->luck,
        ];
        //插入装备信息
        $model = new UserEquipmentBackpackModel($data);
        $model->save();
        return $model;
    }

    public function addUserEquipmentEntry(UserBackpackModel $backpackInfo, GoodsEquipmentModel $equipmentInfo)
    {
        if ($equipmentInfo->rarityLevel == 1) {
            return [];
        }
//        1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话
        $randNumArr = [
            1 => 0,
            2 => 1,
            3 => 2,
            4 => 3,
            5 => 4,
            6 => 4,
            7 => 4,
        ];
        //词条等级 1普通,2精致,3稀有,4罕见,5传说
        $levelRandArr = [
            1 => [],
            2 => [1, 2],
            3 => [1, 2, 3],
            4 => [1, 2, 3, 4],
            5 => [1, 2, 3, 4, 5],
            6 => [2, 3, 4, 5],
            7 => [3, 4, 5],
        ];
        //装备类型 1武器 2帽子 3衣服 4裤子 5鞋子 6披风  7称号 8项链 9戒指
        //获取装备类型 装备词条类型 0通用 1防具 2武器 3首饰 4称号
        $typeArr = [
            1 => 2,
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1,
            7 => 4,
            8 => 3,
            9 => 3,
        ];

        //获取需要随机的词条
        $list = GoodsEquipmentAttributeEntryModel::create()
            ->where('equipmentEntryType', [$typeArr[$equipmentInfo->equipmentType], 0], 'in')
            ->where('level', $levelRandArr[$equipmentInfo->rarityLevel], 'in')
            ->all();
        $randBeanList = [];
        /**
         * @var $list GoodsEquipmentAttributeEntryModel[]
         */
        foreach ($list as $value) {
            $bean = new Bean();
            $bean->setOdds($value->odds);
            $bean->setValue($value);
            $randBeanList[] = $bean;
        }
        $rand = new Rand($randBeanList);
        for ($i = $randNumArr[$equipmentInfo->rarityLevel]; $i > 0; $i--) {
            $value = $rand->randOne();
            /**
             * @var $goodsEquipmentAttributeEntryInfo GoodsEquipmentAttributeEntryModel
             */
            $goodsEquipmentAttributeEntryInfo = $value->getValue();
            if ($goodsEquipmentAttributeEntryInfo->baseCode == '0001') {//增加固定数值
                $param = json_decode($goodsEquipmentAttributeEntryInfo->param, true);
                //获取到数值
                $num = $equipmentInfo->level * $param['num'];
                $description = $this->getAttributeName($param['attribute']) . " +{$num}";
                $param['num'] = $num;
                $goodsEquipmentAttributeEntryInfo->description = $description;
                $goodsEquipmentAttributeEntryInfo->param = json_encode($param);
                UserGoodsEquipmentAttributeEntryModel::create()->addData($backpackInfo->backpackId, $goodsEquipmentAttributeEntryInfo);
            }
        }
    }

    protected function getAttributeName($type)
    {
        $data = [
            'hp'                     => '血量',
            'mp'                     => '法力',
            'attack'                 => '攻击力',
            'defense'                => '防御力',
            'endurance'              => '耐力',
            'intellect'              => '智力',
            'strength'               => '力量',
            'enduranceQualification' => '耐力资质',
            'intellectQualification' => '智力资质',
            'strengthQualification'  => '力量资质',
            'criticalRate'           => '暴击率',
            'criticalStrikeDamage'   => '暴击伤害',
            'hitRate'                => '命中率',
            'dodgeRate'              => '闪避率',
            'penetrate'              => '穿透力',
            'attackSpeed'            => '攻击速度',
            'userElement'            => '角色元素',
            'attackElement'          => '攻击元素',
            'jin'                    => '金',
            'mu'                     => '木',
            'tu'                     => '土',
            'sui'                    => '水',
            'huo'                    => '火',
            'light'                  => '光',
            'dark'                   => '暗',
            'luck'                   => '幸运值',
        ];
        return $data[$type] ?? '';
    }
}
