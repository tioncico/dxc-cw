<?php

namespace App\Model\Game\Cdk;

use App\Model\BaseModel;

/**
 * UserCdkReceiveModel
 * Class UserCdkReceiveModel
 * Create With ClassGeneration
 * @property int $receiveId //
 * @property int $userId // 用户id
 * @property int $cdkId // cdkId
 * @property int $addTime // 领取时间
 */
class UserCdkReceiveModel extends BaseModel
{
	protected $tableName = 'user_cdk_receive_list';


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

	public function getInfo($userId,$cdkId){
	    return $this->where('userId',$userId)->where('cdkId',$cdkId)->get();
    }

	public function addData(int $userId, int $cdkId): self
	{
		$data = [
		    'userId'=>$userId,
		    'cdkId'=>$cdkId,
		    'addTime'=>time(),
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

