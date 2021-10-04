<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserExtraLimitModel
 * Class UserExtraLimitModel
 * Create With ClassGeneration
 * @property int $userId //
 * @property int $petNum // 宠物数量
 * @property int $backpackNum // 背包数量
 */
class UserExtraLimitModel extends BaseModel
{
	protected $tableName = 'user_extra_limit_list';


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


	public function addData(int $userId, int $petNum, int $backpackNum): self
	{
		$data = [
		    'userId'=>$userId,
		    'petNum'=>$petNum,
		    'backpackNum'=>$backpackNum,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}

	public function getInfo($userId){
	    $info = $this->get(['userId'=>$userId]);
	    if (empty($info)){
	        $info = $this->addData($userId,100,100);
        }
	    return $info;
    }

    public function getBackPackNum($userId){
	    $info = $this->getInfo($userId);
	    return $info->backpackNum;
    }
    public function getPetNum($userId){
	    $info = $this->getInfo($userId);
	    return $info->petNum;
    }
}

