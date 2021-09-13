<?php

namespace UnitTest\User;

use GoodsEquipmentAttributeEntryModel;

/**
 * GoodsEquipmentAttributeEntryTest
 * Class GoodsEquipmentAttributeEntryTest
 * Create With ClassGeneration
 */
class GoodsEquipmentAttributeEntryTest extends UserBaseTestCase
{
	public $modelName = 'GoodsEquipmentAttributeEntry';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本dcaKBY';
		$data['equipmentEntryType'] = '1';
		$data['baseCode'] = '测试文本A5YVgu';
		$data['level'] = '29096';
		$data['description'] = '测试文本GfvpqY';
		$data['param'] = '测试文本pK6YgL';
		$data['odds'] = '29305';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->destroy($response->result->code);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本gPsK7r';
		$data['equipmentEntryType'] = '0';
		$data['baseCode'] = '测试文本MVY7sW';
		$data['level'] = '92790';
		$data['description'] = '测试文本gZAd8t';
		$data['param'] = '测试文本wDfzLn';
		$data['odds'] = '61020';
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$data = [];
		$data['code'] = $model->code;
		$response = $this->request('getOne',$data);
		$model->destroy($model->code);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本XS2a4V';
		$data['equipmentEntryType'] = '2';
		$data['baseCode'] = '测试文本blPed5';
		$data['level'] = '60577';
		$data['description'] = '测试文本NURaDs';
		$data['param'] = '测试文本nUB8rQ';
		$data['odds'] = '20357';
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$update = [];
		$update['code'] = $model->code;
		$update['name'] = '测试文本OmiV1Z';
		$update['equipmentEntryType'] = '1';
		$update['baseCode'] = '测试文本193p0k';
		$update['level'] = '30189';
		$update['description'] = '测试文本XtdoSQ';
		$update['param'] = '测试文本OuqDCt';
		$update['odds'] = '15111';
		$response = $this->request('update',$update);
		$model->destroy($model->code);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GoodsEquipmentAttributeEntryModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本6QunD7';
		$data['equipmentEntryType'] = '0';
		$data['baseCode'] = '测试文本7nsQLG';
		$data['level'] = '86377';
		$data['description'] = '测试文本nOi9Hu';
		$data['param'] = '测试文本PvdBi8';
		$data['odds'] = '29668';
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$delData = [];
		$delData['code'] = $model->code;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

