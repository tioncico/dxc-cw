<?php

namespace App\Model;

/**
 * ServerModel
 * Class ServerModel
 * Create With ClassGeneration
 * @property int $serverId // 服务器id
 * @property string $serverName // 服务器名
 * @property int $isAllowRegister // 是否允许注册
 * @property string $serverHost // 服务器host
 */
class ServerModel extends BaseModel
{
	protected $tableName = 'server_list';


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

