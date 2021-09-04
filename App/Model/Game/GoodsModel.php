<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * GoodsModel
 * Class GoodsModel
 * Create With ClassGeneration
 * @property int $goodsId // 物品id
 * @property string $name // 物品名称
 * @property string $code // 物品code值
 * @property int $type // 类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备
 * @property string $description // 介绍
 * @property int $gold // 售出金币
 * @property int $isSale // 是否可售出
 * @property int $level // 等级
 * @property int $rarityLevel // 稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话
 * @property string $extraData // 额外数据
 */
class GoodsModel extends BaseModel
{
	protected $tableName = 'goods_list';


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

	public function getInfoByCode($code){
	    return $this->where('code',$code)->get();
    }
}

