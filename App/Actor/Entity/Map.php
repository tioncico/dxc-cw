<?php


namespace App\Actor\Entity;


use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Model\User\UserModel;
use EasySwoole\Spl\SplBean;

class Map
{
    /**
     * @var MapModel
     */
    protected $mapInfo;//地图信息

    /**
     * @var MapMonsterModel[]
     */
    protected $mapMonsterList;//地图怪物列表

    /**
     * @var int
     */
    protected $mapLevel;//当前地图关卡

    protected $mapGrid=[];//地图坐标

    public function __construct(int $mapId)
    {
        //初始化地图数据

    }

    protected function initMapInfo(){

    }
}
