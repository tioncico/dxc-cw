<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\PetModel;
use App\Model\Game\PetSkillModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserPetModel;
use App\Model\Game\UserPetSkillModel;
use App\Service\GameResponse;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Component\Singleton;

class PetService
{
    use Singleton;

    /**
     * 新增宠物
     * addUserPet
     * @param          $userId
     * @param PetModel $petModel
     * @author tioncico
     * Time: 4:11 下午
     */
    public function addUserPet($userId, PetModel $petModel)
    {
        $data = [
            'petId'                  => $petModel->petId,
            'userId'                 => $userId,
            'name'                   => $petModel->name,
            'type'                   => $petModel->type,
            'isUse'                  => 0,
            'description'            => $petModel->description,
            'level'                  => 1,
            'classLevel'             => 0,
            'awakeLevel'             => 0,
            'exp'                    => 0,
            'isBest'                 => 0,
            'hp'                     => $petModel->hp,
            'mp'                     => $petModel->mp,
            'attack'                 => $petModel->attack,
            'defense'                => $petModel->defense,
            'endurance'              => $petModel->endurance,
            'intellect'              => $petModel->intellect,
            'strength'               => $petModel->strength,
            'enduranceQualification' => $petModel->enduranceQualification,
            'intellectQualification' => $petModel->intellectQualification,
            'strengthQualification'  => $petModel->strengthQualification,
            'criticalRate'           => $petModel->criticalRate,
            'criticalStrikeDamage'   => $petModel->criticalStrikeDamage,
            'hitRate'                => $petModel->hitRate,
            'dodgeRate'              => $petModel->dodgeRate,
            'penetrate'              => $petModel->penetrate,
            'attackSpeed'            => $petModel->attackSpeed,
            'userElement'            => $petModel->userElement,
            'attackElement'          => $petModel->attackElement,
            'jin'                    => $petModel->jin,
            'mu'                     => $petModel->mu,
            'tu'                     => $petModel->tu,
            'sui'                    => $petModel->sui,
            'huo'                    => $petModel->huo,
            'light'                  => $petModel->light,
            'dark'                   => $petModel->dark,
        ];
        $data['enduranceQualification'] = mt_rand(($petModel->enduranceQualification * 0.5), $petModel->enduranceQualification);
        $data['intellectQualification'] = mt_rand(($petModel->intellectQualification * 0.5), $petModel->intellectQualification);
        $data['strengthQualification'] = mt_rand(($petModel->strengthQualification * 0.5), $petModel->strengthQualification);
        if ($data['enduranceQualification'] == $petModel->enduranceQualification && $data['intellectQualification'] == $petModel->intellectQualification && $data['strengthQualification'] == $petModel->strengthQualification) {
            $data['isBest'] = 1;
        }
        $model =    BaseModel::create(function ()use($data){
            $model = new UserPetModel($data);
            $model->save();
            $this->addPetSkill($model);
            return $model;
        });
        return $model;
    }

    public function addPetSkill(UserPetModel $userPetModel)
    {
        $petSkillList  = PetSkillModel::create()->where('petId',$userPetModel->petId)->all();
        foreach ($petSkillList as $petSkill){
            $data = [
                'userId'=>$userPetModel->userId,
                'userPetId'=>$userPetModel->userPetId,
                'skillId'=>$petSkill->skillId,
                'skillName'=>$petSkill->skillName,
                'triggerType'=>$petSkill->triggerType,
                'triggerRate'=>$petSkill->triggerRate,
                'isUse'=>$petSkill->isUse,
                'level'=>$petSkill->level,
                'rarityLevel'=>$petSkill->rarityLevel,
                'maxLevel'=>$petSkill->maxLevel,
                'coolingTime'=>$petSkill->coolingTime,
                'manaCost'=>$petSkill->manaCost,
                'entryCode'=>$petSkill->entryCode,
                'description'=>$petSkill->description,
                'effectParam'=>$petSkill->effectParam,
            ];
            $skill = new UserPetSkillModel($data);
            $skill->save();
        }
    }


    /**
     * 宠物上阵
     * usePet
     * @param UserPetModel $userPetInfo
     * @return mixed
     * @throws \Throwable
     * @author tioncico
     * Time: 10:54 上午
     */
    public function usePet(UserPetModel $userPetInfo)
    {
        $info = BaseModel::transaction(function () use ($userPetInfo) {
            //将宠物更新为已上阵
            $userPetInfo->update(['isUse' => 1]);
            GameResponse::getInstance()->addPet($userPetInfo, 0);
            return $userPetInfo;
        });
        return $info;
    }

    public function noUsePet(UserPetModel $userPetInfo)
    {
        $info = BaseModel::transaction(function () use ($userPetInfo) {
            //将宠物更新为已上阵
            $userPetInfo->update(['isUse' => 0]);
            GameResponse::getInstance()->addPet($userPetInfo, 0);
            return $userPetInfo;
        });
        return $info;
    }

    public function decompose(UserPetModel $userPetInfo)
    {
        $info = BaseModel::transaction(function () use ($userPetInfo) {
            //分解宠物可以获取宠物灵魂和宠物精华和宠物经验球
            $goodsList = $this->getUpClassLevelNeedGoods($userPetInfo);
            foreach ($goodsList as $value) {
                $num = $value['num'];
                /**
                 * @var $goodsInfo GoodsModel
                 */
                $goodsInfo = $value['goodsInfo'];
                BackpackService::getInstance()->addGoods($userPetInfo->userId, $goodsInfo, $num);
            }
            //todo 计算经验球


            //删除宠物
            $userPetInfo->destroy();


            return $userPetInfo;
        });
        return $info;
    }

    /**
     * 宠物升阶
     * upClassLevel
     * @param UserPetModel $userPetInfo
     * @return mixed
     * @throws \Throwable
     * @author tioncico
     * Time: 4:01 下午
     */
    public function upClassLevel(UserPetModel $userPetInfo)
    {
        $info = BaseModel::transaction(function () use ($userPetInfo) {
            $userPetInfo = $userPetInfo->lockForUpdate()->get($userPetInfo->userPetId);
            //宠物升阶需要宠物精华和宠物灵魂
            $goodsList = $this->getUpClassLevelNeedGoods($userPetInfo);
            foreach ($goodsList as $value) {
                $num = $value['num'];
                /**
                 * @var $goodsInfo GoodsModel
                 */
                $goodsInfo = $value['goodsInfo'];
                $userBackpackInfo = UserBackpackModel::create()->getInfoByCode($userPetInfo->userId, $goodsInfo->code);
                Assert::assert($userBackpackInfo->num > $num, "物品 [{$goodsInfo->name}] 数量不足");
                BackpackService::getInstance()->decGoods($userPetInfo->userId, $goodsInfo, $num);
            }
            $userPetInfo->update(['classLevel' => $userPetInfo->classLevel + 1]);
            $this->countPetAttribute($userPetInfo);
            GameResponse::getInstance()->addPet($userPetInfo, 0);
            return $userPetInfo;
        });
        return $info;
    }


    public function countPetAttribute(UserPetModel $userPetModel)
    {
        //宠物的属性基本不变
        //hp
        //attack
        //defense
        //endurance 耐力
        //intellect 智力
        //strength 力量
        //enduranceQualification
        //intellectQualification
        //strengthQualification
        //宠物  耐力算法 = 宠物耐力资质*宠物等级*(5+宠物阶级*5)/100
        $endurance = $userPetModel->enduranceQualification * $userPetModel->level * (5 + $userPetModel->classLevel * 5) / 100;
        $intellect = $userPetModel->intellect * $userPetModel->level * (5 + $userPetModel->classLevel * 5) / 100;
        $strength = $userPetModel->strength * $userPetModel->level * (5 + $userPetModel->classLevel * 5) / 100;
        $hp = $userPetModel->level * 100 + $userPetModel->endurance * 100;
        $attack = 1 + ($userPetModel->level * 5 + $userPetModel->strength * 10);
        $defense = 0 + (($userPetModel->level - 1) * 2 + $userPetModel->endurance * 10);
        $userPetModel->endurance = $endurance;
        $userPetModel->intellect = $intellect;
        $userPetModel->strength = $strength;
        $userPetModel->hp = $hp;
        $userPetModel->attack = $attack;
        $userPetModel->defense = $defense;
        $userPetModel->update();
        return $userPetModel;
    }

    public function getUpClassLevelNeedGoods(UserPetModel $userPetInfo)
    {
        //计算宠物精华 = 需要升级的宠物阶级*10
        $petEssenceNum = ($userPetInfo->classLevel + 1) * 100;
        //计算宠物灵魂需要数量 = 需要升级的宠物阶级*2
        $petSoulNum = $this->countPetSoulNum($userPetInfo->classLevel + 1);

        return [
            [
                'num'       => $petEssenceNum,
                'goodsInfo' => GoodsModel::create()->getInfoByCode('petEssence')
            ],
            [
                'num'       => $petSoulNum,
                'goodsInfo' => GoodsModel::create()->getInfoByCode("petSoul{$userPetInfo->petId}")
            ],
        ];
    }

    public function countPetSoulNum($classLevel)
    {
        $arr = [
            0  => 1,
            1  => 1,
            2  => 2,
            3  => 5,
            4  => 10,
            5  => 20,
            6  => 40,
            7  => 70,
            8  => 80,
            9  => 100,
            10 => 200,
            11 => 200,
            12 => 200,
        ];
        return $arr[$classLevel];
    }


    public function getUserPetList($userId)
    {
        //获取用户携带的3只宠物
        $userPetList = [];
        $list = UserPetModel::create()->where('userId', $userId)->where('isUse', 1)->all();
        /**
         * @var UserPetModel $value
         */
        foreach ($list as $value) {
            $userPetList[$value->userPetId] = $value;
        }
        return $userPetList;
    }
}
