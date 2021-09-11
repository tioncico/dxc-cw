<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserSignModel
 * Class UserSignModel
 * Create With ClassGeneration
 * @property int $userId // 用户id
 * @property int $signNum // 签到天数
 * @property int $lastUpdateTime // 最后更新时间
 */
class UserSignModel extends BaseModel
{
	protected $tableName = 'user_sign_list';


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

	public function addData($userId){
        $data = [
            'userId'=>$userId,
            'signNum'=>0,
            'lastUpdateTime'=>0,
        ];
        $model = new UserSignModel($data);
        $model->save();
        return $model;
    }

    public function getInfo($userId){
        $info = self::create()->get($userId);
        if (empty($info)){
            $info = $this->addData($userId);
        }
        return $info;
    }
}

