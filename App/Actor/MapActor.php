<?php


namespace App\Actor;


use App\Actor\Cache\UserRelationMap;
use App\Model\Game\GoodsModel;
use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserSkillModel;
use App\Model\User\UserModel;
use App\Service\Game\Attribute;
use App\Service\Game\Fight\Fight;
use App\Service\Game\Fight\FightResult;
use App\Service\Game\Fight\Reward;
use App\Service\Game\SkillAttribute;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;
use App\WebSocket\MsgPushEvent;
use EasySwoole\Actor\AbstractActor;
use EasySwoole\Actor\ActorConfig;
use Swoole\Coroutine\Channel;
use function AlibabaCloud\Client\value;

class MapActor extends BaseActor
{

}
