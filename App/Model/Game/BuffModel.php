<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * BuffModel
 * Class BuffModel
 * Create With ClassGeneration
 * @property int $buffId //
 * @property string $name // buff名称
 * @property string $code // buffcode
 * @property int $stackLayer // 最大叠加层数
 * @property string $entryCode // 词条code
 * @property string $param // 参数
 * @property string $description // 介绍
 */
class BuffModel extends BaseModel
{
	protected $tableName = 'buff_list';


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

