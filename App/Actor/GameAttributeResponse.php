<?php


namespace App\Actor;


use EasySwoole\Component\Singleton;

class GameAttributeResponse extends \App\Service\GameResponse
{
    use Singleton;
    const USER_KEY = 'userChangeAttribute';
    const USER_PET_KEY = 'userPetChangeAttribute';
    const MONSTER_KEY = 'monsterChangeAttribute';

    public function addAttribut(){

    }

}
