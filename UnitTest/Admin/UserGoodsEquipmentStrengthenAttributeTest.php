<?php

namespace UnitTest\Admin;

use App\Model\UserGoodsEquipmentStrengthenAttributeModel;

/**
 * UserGoodsEquipmentStrengthenAttributeTest
 * Class UserGoodsEquipmentStrengthenAttributeTest
 * Create With ClassGeneration
 */
class UserGoodsEquipmentStrengthenAttributeTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/UserGoodsEquipmentStrengthenAttribute';


	public function testAdd()
	{
		$data = [];
		$data['strengthenLevel'] = '38636';
		$data['hp'] = '48872';
		$data['attack'] = '98914';
		$data['defense'] = '51162';
		$response = $this->request('add',$data);
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['strengthenLevel'] = '22937';
		$data['hp'] = '82121';
		$data['attack'] = '49861';
		$data['defense'] = '70780';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$data = [];
		$data['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userEquipmentBackpackId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['strengthenLevel'] = '31066';
		$data['hp'] = '35911';
		$data['attack'] = '79275';
		$data['defense'] = '98527';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['strengthenLevel'] = '10574';
		$update['hp'] = '94644';
		$update['attack'] = '23942';
		$update['defense'] = '32612';
		$response = $this->request('update',$update);
		$model->destroy($model->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['strengthenLevel'] = '22651';
		$data['hp'] = '61273';
		$data['attack'] = '92255';
		$data['defense'] = '76921';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

