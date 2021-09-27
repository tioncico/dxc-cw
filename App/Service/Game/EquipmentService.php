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
use App\Service\GameResponse;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;
use EasySwoole\Component\Singleton;

class EquipmentService extends BaseService
{
    use Singleton;

    public function getUserEquipmentList($userId)
    {
        $list = UserEquipmentBackpackModel::create()->where('isUse', 1)->where('userId', $userId)->all();
        $userEquipmentList = [];
        /**
         * @var $value UserEquipmentBackpackModel
         */
        foreach ($list as $value) {
            $userEquipmentList[$value->equipmentType] = $value;
        }
        return $userEquipmentList;
    }

    /**
     * 分解装备
     * decomposeEquipment
     * @param UserEquipmentBackpackModel $equipmentInfo
     * @author tioncico
     * Time: 8:11 下午
     */
    public function decomposeEquipment(UserEquipmentBackpackModel $equipmentInfo)
    {
        //用户装备信息包括
        //用户物品栏数据
        //用户装备数据
        //装备附加属性
        //装备强化属性
        //分解材料数量 = 装备等级*装备品级*装备强化等级*5
        $goodsList = BaseModel::transaction(function () use ($equipmentInfo) {
            $materialNum = intval($equipmentInfo->level * $equipmentInfo->rarityLevel * ($equipmentInfo->strengthenLevel + 1) * 5);
            //增加物品
            $materialInfo = GoodsModel::create()->getInfoByCode('material00001');
            $backpackInfo = BackpackService::getInstance()->addGoods($equipmentInfo->userId, $materialInfo, $materialNum);
            //删除背包
            UserBackpackModel::create()->destroy(['backpackId' => $equipmentInfo->backpackId]);
            //删除装备附件属性
            UserGoodsEquipmentAttributeEntryModel::create()->destroy(['backpackId' => $equipmentInfo->backpackId]);
            //删除装备强化属性
            UserGoodsEquipmentStrengthenAttributeModel::create()->destroy(['userEquipmentBackpackId' => $equipmentInfo->backpackId]);
            //删除装备属性
            $equipmentInfo->destroy();
            GameResponse::getInstance()->addEquipment($equipmentInfo, -1);
        });
    }

    /**
     * 新增用户装备
     * addUserEquipment
     * @param                     $userId
     * @param GoodsModel          $goodsInfo
     * @param GoodsEquipmentModel $equipmentInfo
     * @throws \Throwable
     * @author tioncico
     * Time: 9:16 下午
     */
    public function addUserEquipment($userId, GoodsModel $goodsInfo): UserBackpackModel
    {
        return BaseModel::transaction(function () use ($userId, $goodsInfo) {
            //新增装备信息到背包
            $backpackInfo = UserBackpackModel::create()->addData($userId, $goodsInfo, 1);

            $equipmentInfo = GoodsEquipmentModel::create()->get(['goodsCode' => $goodsInfo->code]);
            //新增用户装备信息
            $userEquipmentBackpackInfo = $this->addUserEquipmentBackpack($userId, $backpackInfo, $equipmentInfo);
            GameResponse::getInstance()->addEquipment($userEquipmentBackpackInfo, 1);
            //随机装备词条
            $entryArr = $this->addUserEquipmentEntry($backpackInfo, $equipmentInfo);
            //更新装备本身的词条介绍
            $this->updateEquipmentAttributeDescription($userEquipmentBackpackInfo);
            //更新装备词条介绍
            $this->updateEquipmentAttributeEntryDescription($userEquipmentBackpackInfo, $entryArr);
            //更新装备额外词条

            //更新装备套装词条
            return $backpackInfo;
        });
    }

    /**
     * 穿戴装备
     * useEquipment
     * @param UserEquipmentBackpackModel $userEquipmentBackpackModel
     * @author tioncico
     * Time: 9:59 上午
     */
    public function useEquipment(UserEquipmentBackpackModel $userEquipmentBackpackModel)
    {
        //查看该部位是不是有旧装备存在
        $oldUserUseEquipment = UserEquipmentBackpackModel::create()->where('equipmentType', $userEquipmentBackpackModel->equipmentType)->where('userId', $userEquipmentBackpackModel->userId)->where('isUse', 1)->get();
        return BaseModel::transaction(function () use ($userEquipmentBackpackModel, $oldUserUseEquipment) {
            if ($oldUserUseEquipment) {
                $oldUserUseEquipment->update(['isUse' => 0]);
            }
            $userEquipmentBackpackModel->update(['isUse' => 1]);
            //更新用户属性
            return UserService::getInstance()->countUserAttribute($userEquipmentBackpackModel->userId);
        });
    }

    /**
     * 装备信息插入
     * addUserEquipmentBackpack
     * @param                     $userId
     * @param UserBackpackModel   $backpackInfo
     * @param GoodsEquipmentModel $equipmentInfo
     * @return UserEquipmentBackpackModel
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 9:45 下午
     */
    protected function addUserEquipmentBackpack($userId, UserBackpackModel $backpackInfo, GoodsEquipmentModel $equipmentInfo)
    {

        $data = [
            'backpackId'                => $backpackInfo->backpackId,
            'userId'                    => $userId,
            'isUse'                     => 0,
            'strengthenLevel'           => 0,
            'goodsCode'                 => $equipmentInfo->goodsCode,
            'goodsName'                 => $equipmentInfo->goodsName,
            'equipmentType'             => $equipmentInfo->equipmentType,
            'suitCode'                  => $equipmentInfo->suitCode,
            'rarityLevel'               => $equipmentInfo->rarityLevel,
            'level'                     => $equipmentInfo->level,
            'attributeDescription'      => $equipmentInfo->attributeDescription,
            'attributeEntryDescription' => $equipmentInfo->attributeEntryDescription,
            'extraAttributeDescription' => $equipmentInfo->extraAttributeDescription,
            'suitAttribute2Description' => $equipmentInfo->suitAttribute2Description,
            'suitAttribute3Description' => $equipmentInfo->suitAttribute3Description,
            'suitAttribute5Description' => $equipmentInfo->suitAttribute5Description,
            'hp'                        => $equipmentInfo->hp,
            'mp'                        => $equipmentInfo->mp,
            'attack'                    => $equipmentInfo->attack,
            'defense'                   => $equipmentInfo->defense,
            'endurance'                 => $equipmentInfo->endurance,
            'intellect'                 => $equipmentInfo->intellect,
            'strength'                  => $equipmentInfo->strength,
            'criticalRate'              => $equipmentInfo->criticalRate,
            'criticalStrikeDamage'      => $equipmentInfo->criticalStrikeDamage,
            'hitRate'                   => $equipmentInfo->hitRate,
            'dodgeRate'                 => $equipmentInfo->dodgeRate,
            'penetrate'                 => $equipmentInfo->penetrate,
            'attackSpeed'               => $equipmentInfo->attackSpeed,
            'userElement'               => $equipmentInfo->userElement,
            'attackElement'             => $equipmentInfo->attackElement,
            'jin'                       => $equipmentInfo->jin,
            'mu'                        => $equipmentInfo->mu,
            'tu'                        => $equipmentInfo->tu,
            'sui'                       => $equipmentInfo->sui,
            'huo'                       => $equipmentInfo->huo,
            'light'                     => $equipmentInfo->light,
            'dark'                      => $equipmentInfo->dark,
            'luck'                      => $equipmentInfo->luck,
        ];
        //插入装备信息
        $model = new UserEquipmentBackpackModel($data);
        $model->save();
        return $model;
    }

    /**
     * 装备属性插入
     * addUserEquipmentEntry
     * @param UserBackpackModel   $backpackInfo
     * @param GoodsEquipmentModel $equipmentInfo
     * @return array
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 9:45 下午
     */
    protected function addUserEquipmentEntry(UserBackpackModel $backpackInfo, GoodsEquipmentModel $equipmentInfo)
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
        $returnArr = [];
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
            $returnArr[] = $goodsEquipmentAttributeEntryInfo;
        }

        return $returnArr;
    }

    /**
     * updateEquipmentAttributeEntryDescription
     * @param UserEquipmentBackpackModel $userEquipmentBackpackInfo
     * @param array                      $goodsEquipmentAttributeEntryInfoArr
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 9:46 下午
     */
    protected function updateEquipmentAttributeEntryDescription(UserEquipmentBackpackModel $userEquipmentBackpackInfo, array $goodsEquipmentAttributeEntryInfoArr)
    {
        /**
         * @var GoodsEquipmentAttributeEntryModel[] $goodsEquipmentAttributeEntryInfoArr
         */

        $descriptionArr = [];
        foreach ($goodsEquipmentAttributeEntryInfoArr as $goodsEquipmentAttributeEntryInfo) {
            $descriptionArr[] = $this->handleUbb($goodsEquipmentAttributeEntryInfo->level, $goodsEquipmentAttributeEntryInfo->description);
        }
        $userEquipmentBackpackInfo->update([
            'attributeEntryDescription' => implode("\n", $descriptionArr),
        ]);
    }

    /**
     * 更新装备属性介绍
     * updateEquipmentAttributeDescription
     * @param UserEquipmentBackpackModel $userEquipmentBackpackInfo
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author tioncico
     * Time: 10:24 上午
     */
    protected function updateEquipmentAttributeDescription(UserEquipmentBackpackModel $userEquipmentBackpackInfo)
    {
        $descriptionArr = [];
        foreach ($this->getAttributeName() as $key => $name) {
            if ($userEquipmentBackpackInfo->$key > 0) {
                $descriptionArr[] = $this->handleUbb(1, "{$name}+{$userEquipmentBackpackInfo->$key}");
            }
        }
        $userEquipmentBackpackInfo->update([
            'attributeDescription' => implode("\n", $descriptionArr),
        ]);
    }

    protected function getAttributeName($type = null)
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
        return $data[$type] ?? $data;
    }

    protected function handleUbb($level, $description)
    {
//        白
#00FF00 绿
#0000FF 蓝
#FFFF00 黄
#FF00FF 紫
#FF0000 红
        $arr = [
            1 => '#FFFFFF',//白
            2 => '#0000FF',//蓝
            3 => '#FF00FF',//紫
            4 => '#FFFF00',//黄
            5 => '#FFA500',//橙色
            6 => 'FF0000',//红色
            7 => 'FF0000',//深红
        ];
        return "[color={$arr[$level]}]{$description}[/color]";
    }
}
