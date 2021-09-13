<?php

namespace App\Model\Game;

use App\Model\BaseModel;

/**
 * UserGoodsEquipmentAttributeEntryModel
 * Class UserGoodsEquipmentAttributeEntryModel
 * Create With ClassGeneration
 * @property int $id //
 * @property int $backpackId //
 * @property string $code // 词条code
 * @property string $baseCode // 基础词条code
 * @property string $name // 词条名
 * @property int $level // 词条等级
 * @property string $description // 介绍
 * @property string $param // 参数 json数组,例如词条为:"攻击力增加x",那param就只有一个参数,参数为数字
 */
class UserGoodsEquipmentAttributeEntryModel extends BaseModel
{
	protected $tableName = 'user_goods_equipment_attribute_entry_list';


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

	public function addData($backpackId,GoodsEquipmentAttributeEntryModel $entryModel){
        $data = [
            'backpackId'=>$backpackId,
            'code'=>$entryModel->code,
            'baseCode'=>$entryModel->baseCode,
            'name'=>$entryModel->name,
            'level'=>$entryModel->level,
            'description'=>$entryModel->description,
            'param'=>$entryModel->param,
        ];
        $model = new UserGoodsEquipmentAttributeEntryModel($data);
        $model->save();
    }
}

