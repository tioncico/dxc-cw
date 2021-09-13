<?php

namespace UnitTest\Admin;

use GoodsEquipmentAttributeEntryModel;

/**
 * GoodsEquipmentAttributeEntryTest
 * Class GoodsEquipmentAttributeEntryTest
 * Create With ClassGeneration
 */
class GoodsEquipmentAttributeEntryTest extends AdminBaseTestCase
{
	public $modelName = 'GoodsEquipmentAttributeEntry';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本ZH0Ldh';
		$data['equipmentEntryType'] = '1';
		$data['baseCode'] = '测试文本ZG4sAe';
		$data['level'] = '85112';
		$data['description'] = '测试文本frgjQl';
		$data['param'] = '测试文本Xt07fL';
		$data['odds'] = '48132';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->destroy($response->result->code);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本3kpX2K';
		$data['equipmentEntryType'] = '1';
		$data['baseCode'] = '测试文本aFZ0lT';
		$data['level'] = '81466';
		$data['description'] = '测试文本oi1VJE';
		$data['param'] = '测试文本6Fu0sY';
		$data['odds'] = '62532';
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
		$data['name'] = '测试文本mLhc2S';
		$data['equipmentEntryType'] = '0';
		$data['baseCode'] = '测试文本6Rnf2T';
		$data['level'] = '55337';
		$data['description'] = '测试文本rH8vfw';
		$data['param'] = '测试文本Zqe8Eu';
		$data['odds'] = '28202';
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$update = [];
		$update['code'] = $model->code;
		$update['name'] = '测试文本PMEu3R';
		$update['equipmentEntryType'] = '3';
		$update['baseCode'] = '测试文本WBk8Vq';
		$update['level'] = '56557';
		$update['description'] = '测试文本9kHuoe';
		$update['param'] = '测试文本7mziOb';
		$update['odds'] = '72675';
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
		$data['name'] = '测试文本Pv1uRN';
		$data['equipmentEntryType'] = '2';
		$data['baseCode'] = '测试文本ifeoXp';
		$data['level'] = '93315';
		$data['description'] = '测试文本5zWGiw';
		$data['param'] = '测试文本Q6OAz0';
		$data['odds'] = '85750';
		$model = new GoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$delData = [];
		$delData['code'] = $model->code;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

