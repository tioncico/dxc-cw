<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * BuffModel
 * Class BuffModel
 * Create With ClassGeneration
 * @property int $buffId //
 * @property string $name // buff名称
 * @property int $isDebuff // 是否为debuff
 * @property string $code // buffcode
 * @property int $stackLayer // 最大叠加层数
 * @property string $entryCode // 词条code
 * @property string $param // 参数
 * @property int $type // 触发类型, 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发
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

