<?php


namespace App\Service\Game;


use App\Model\Game\PetModel;
use App\Model\Game\UserPetModel;
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

        $model = new UserPetModel($data);
        $model->save();
        return $model;
    }


}
