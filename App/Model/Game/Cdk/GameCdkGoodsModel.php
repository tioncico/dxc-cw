<?php

namespace App\Model\Game\Cdk;

use App\Model\BaseModel;

/**
 * GameCdkGoodsModel
 * Class GameCdkGoodsModel
 * Create With ClassGeneration
 * @property int $cdkGoodsId // id
 * @property int $cdkId // cdkId
 * @property string $goodsCode // 物品code
 * @property int $goodsNum // 物品数量
 */
class GameCdkGoodsModel extends BaseModel
{
	protected $tableName = 'game_cdk_goods_list';


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


	public function addData(int $cdkId, string $goodsCode, int $goodsNum): self
	{
		$data = [
		    'cdkId'=>$cdkId,
		    'goodsCode'=>$goodsCode,
		    'goodsNum'=>$goodsNum,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}
}

