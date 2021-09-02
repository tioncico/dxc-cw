<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use App\Model\User\UserModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * UserMapModel
 * Class UserMapModel
 * Create With ClassGeneration
 * @property int $userMapId //
 * @property int $userId // 用户id
 * @property int $mapId // 地图id
 * @property int $addTime // 新增时间
 */
class UserMapModel extends BaseModel
{
	protected $tableName = 'user_map_list';


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
		    'page'=>$page,
		    'pageSize'=>$pageSize,
		    'list'=>$list,
		    'total'=>$total,
		    'pageCount'=>ceil($total / $pageSize)
		];
		return $data;
	}

	public function addData($userId,$mapId){

        $data = [
            'userId'=>$userId,
            'mapId'=>$mapId,
            'addTime'=>time(),
        ];
        $model = new UserMapModel($data);
        $model->save();
        return $model;
    }

    public function mapInfo()
    {
        return $this->hasOne(MapModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'mapId', 'mapId');
    }

}

