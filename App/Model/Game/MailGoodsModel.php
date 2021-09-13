<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * MailGoodsModel
 * Class MailGoodsModel
 * Create With ClassGeneration
 * @property int $id //
 * @property int $mailId // 邮件id
 * @property string $goodsCode // 物品id
 * @property int $num // 数量
 *
 * @property GoodsModel $goodsInfo
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

	public function addData($mailId,$goodsCode,$num){
        $data = [
            'mailId'=>$mailId,
            'goodsCode'=>$goodsCode,
            'num'=>$num,
        ];
        $model = new MailGoodsModel($data);
        $model->save();
        return $model;
    }


    public function goodsInfo()
    {
        return $this->hasOne(GoodsModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'goodsCode', 'code');
    }
}

