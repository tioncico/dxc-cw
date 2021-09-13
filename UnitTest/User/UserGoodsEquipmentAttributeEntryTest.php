<?php

namespace UnitTest\User;

use UserGoodsEquipmentAttributeEntryModel;

/**
 * UserGoodsEquipmentAttributeEntryTest
 * Class UserGoodsEquipmentAttributeEntryTest
 * Create With ClassGeneration
 */
class UserGoodsEquipmentAttributeEntryTest extends UserBaseTestCase
{
	public $modelName = 'UserGoodsEquipmentAttributeEntry';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '35740';
		$data['code'] = '测试文本kNbzt3';
		$data['baseCode'] = '测试文本u4Ld3C';
		$data['name'] = '测试文本I8Usmo';
		$data['level'] = '64510';
		$data['description'] = '测试文本KQn0hB';
		$data['param'] = '测试文本Uhv5LI';
		$response = $this->request('add',$data);
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '42415';
		$data['code'] = '测试文本mFzZcg';
		$data['baseCode'] = '测试文本N2Ul0L';
		$data['name'] = '测试文本tBX5nY';
		$data['level'] = '93689';
		$data['description'] = '测试文本dHJ7b5';
		$data['param'] = '测试文本uBx8Fv';
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$data = [];
		$data['id'] = $model->id;
		$response = $this->request('getOne',$data);
		$model->destroy($model->id);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['backpackId'] = '74399';
		$data['code'] = '测试文本uoWQzH';
		$data['baseCode'] = '测试文本UfSJot';
		$data['name'] = '测试文本ta5QoL';
		$data['level'] = '64337';
		$data['description'] = '测试文本7RvIGl';
		$data['param'] = '测试文本pKjDum';
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['backpackId'] = '77842';
		$update['code'] = '测试文本oA04lb';
		$update['baseCode'] = '测试文本rVp9XZ';
		$update['name'] = '测试文本Lqi9tn';
		$update['level'] = '62811';
		$update['description'] = '测试文本mV53gz';
		$update['param'] = '测试文本qBy9WN';
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['backpackId'] = '46124';
		$data['code'] = '测试文本48ux1n';
		$data['baseCode'] = '测试文本Ay4tqI';
		$data['name'] = '测试文本0Z4ynL';
		$data['level'] = '78420';
		$data['description'] = '测试文本FlUWk1';
		$data['param'] = '测试文本SvNp2i';
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

