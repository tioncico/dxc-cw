<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * RealNameAuthenticationModel
 * Class RealNameAuthenticationModel
 * Create With ClassGeneration
 * @property int $userId //
 * @property string $idCard // 身份证号
 * @property string $realName // 真实姓名
 */
class RealNameAuthenticationModel extends BaseModel
{
	protected $tableName = 'real_name_authentication_list';


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
}

