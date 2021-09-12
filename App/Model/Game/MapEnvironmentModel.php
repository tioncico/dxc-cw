<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * MapEnvironmentModel
 * Class MapEnvironmentModel
 * Create With ClassGeneration
 * @property int    $mapEnvironmentId // 环境id
 * @property string $name // 环境名
 * @property string $description // 环境介绍
 * @property string $recommendedLevelValue // 建议等级
 * @property int    $isInstanceZone // 是否为副本
 * @property int    $order // 排序
 */
class MapEnvironmentModel extends BaseModel
{
    protected $tableName = 'map_environment_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): array
    {
        $list = $this
            ->withTotalCount()
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->page($page, $pageSize)
            ->all();
        $total = $this->lastQueryResult()->getTotalCount();
        $data = [
            'page'      => $page,
            'pageSize'  => $pageSize,
            'list'      => $list,
            'total'     => $total,
            'pageCount' => ceil($total / $pageSize)
        ];
        return $data;
    }

    public function mapList($userId)
    {
        return $this->hasMany(MapModel::class, function (QueryBuilder $query)use($userId) {
            $query->join('user_map_list', 'user_map_list.mapId = map_list.mapId and user_map_list.userId = '.$userId,'left');
            $query->orderBy('`order`','ASC');
            $query->fields([
                "map_list.*",
                'if(user_map_list.userMapId is null,0,1) as mapIsOpen'
            ]);
            return $query;
        }, 'mapEnvironmentId', 'mapEnvironmentId');
    }


}

