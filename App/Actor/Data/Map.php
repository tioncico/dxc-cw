<?php


namespace App\Actor\Data;


use App\Model\Game\MapModel;
use App\Model\Game\MapMonsterModel;
use App\Utility\Cache\UserCache;
use App\Utility\Rand\Bean;
use App\Utility\Rand\Rand;

class Map
{
    /**
     * @var MapModel
     */
    public $mapInfo;//地图信息
    /**
     * @var MapMonsterModel
     */
    public $mapMonsterList;//地图怪物信息
    /**
     * @var int
     */
    public $nowMapLevel;//当前地图层数

    /**
     * @var MapMonsterModel[][]
     */
    public $nowMapGrid = [

    ];//当前地图宫格情况 type 0没有数据,1怪物,2宝箱,3buff

    public function __construct($mapId)
    {
        $this->initMap($mapId);
        $this->initMapMonsterList();
        $this->initGrid();
    }

    public function initMap($mapId)
    {
        $this->mapInfo = MapModel::create()->get($mapId);
        $this->nowMapLevel = 1;
    }

    public function initMapMonsterList()
    {
        $mapId = $this->mapInfo->mapId;
        $mapMonsterList = MapMonsterModel::create()->where('mapId', $mapId)->all();
        /**
         * @var $monster MapMonsterModel
         */
        foreach ($mapMonsterList as $monster) {
            $this->mapMonsterList[$monster->type][] = $monster;
        }
    }

    public function initGrid()
    {
        $maxX = 5;
        $maxY = 5;
        $grid = [];
        $randList = [];
        for ($x = 0; $x < $maxX; $x++) {
            for ($y = 0; $y <= $maxY; $y++) {
                $randList[] = new Bean([
                    'odds'  => 1,
                    'value' => [$x, $y]
                ]);
                $grid[$x][$y] = [
                    'type' => '0',
                    'data' => []
                ];
            }
        }
        $this->nowMapGrid = $grid;
        $monsterList = $this->randMapMonster(1, mt_rand(($this->mapInfo->monsterNum * 0.5), $this->mapInfo->monsterNum));

        $randResultList = (new Rand($randList))->randValue(count($monsterList), false);
        $this->nowMapGrid[0][0] =[
            'type' => 1,
            'data' => array_shift($monsterList)
        ];
        foreach ($randResultList as $value) {
            $bean = $value['info'];
            $this->nowMapGrid[$bean->getValue()[0]][$bean->getValue()[1]] = [
                'type' => 1,
                'data' => array_shift($monsterList)
            ];
        }
    }

    public function randMapMonster($type = 1, $num)
    {
        $monsterList = $this->mapMonsterList[$type];
        //随机n个怪物
        $randList = [];
        foreach ($monsterList as $value) {
            $randList[] = new Bean([
                'odds'  => 1,
                'value' => $value
            ]);
        }
        /**
         * @var $monster MapMonsterModel[]
         */
        $randResultList = (new Rand($randList))->randValue($num);
        $list = [];
        foreach ($randResultList as $result) {
            for ($i = $result['num']; $i > 0; $i--) {
                $list[] = $result['info']->getValue();
            }
        }
        return $list;
    }


    public function toArray(){
        return [
            'mapInfo'=>$this->mapInfo,
//            'mapMonsterList'=>$this->mapMonsterList,
            'nowMapLevel'=>$this->nowMapLevel,
            'nowMapGrid'=>$this->nowMapGrid,
        ];
    }

    /**
     * @return mixed
     */
    public function getMapInfo()
    {
        return $this->mapInfo;
    }

    /**
     * @param mixed $mapInfo
     */
    public function setMapInfo($mapInfo): void
    {
        $this->mapInfo = $mapInfo;
    }

    /**
     * @return mixed
     */
    public function getMapMonsterList()
    {
        return $this->mapMonsterList;
    }

    /**
     * @param mixed $mapMonsterList
     */
    public function setMapMonsterList($mapMonsterList): void
    {
        $this->mapMonsterList = $mapMonsterList;
    }

    /**
     * @return mixed
     */
    public function getNowMapLevel()
    {
        return $this->nowMapLevel;
    }

    /**
     * @param mixed $nowMapLevel
     */
    public function setNowMapLevel($nowMapLevel): void
    {
        $this->nowMapLevel = $nowMapLevel;
    }

    /**
     * @return array
     */
    public function getNowMapGrid(): array
    {
        return $this->nowMapGrid;
    }

    /**
     * @param array $nowMapGrid
     */
    public function setNowMapGrid(array $nowMapGrid): void
    {
        $this->nowMapGrid = $nowMapGrid;
    }


}
