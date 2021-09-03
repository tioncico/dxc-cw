<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * MailGoodsModel
 * Class MailGoodsModel
 * Create With ClassGeneration
 * @property int $id //
 * @property int $mailId // 邮件id
 * @property int $goodsId // 物品id
 * @property int $num // 数量
 */
class MailGoodsModel extends BaseModel
{
	protected $tableName = 'mail_goods_list';


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

