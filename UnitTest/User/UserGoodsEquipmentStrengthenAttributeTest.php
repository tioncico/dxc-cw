<?php

namespace UnitTest\User;

use App\Model\UserGoodsEquipmentStrengthenAttributeModel;

/**
 * UserGoodsEquipmentStrengthenAttributeTest
 * Class UserGoodsEquipmentStrengthenAttributeTest
 * Create With ClassGeneration
 */
class UserGoodsEquipmentStrengthenAttributeTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/UserGoodsEquipmentStrengthenAttribute';


	public function testAdd()
	{
		$data = [];
		$data['strengthenLevel'] = '54773';
		$data['hp'] = '55600';
		$data['attack'] = '42302';
		$data['defense'] = '67654';
		$response = $this->request('add',$data);
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['strengthenLevel'] = '85681';
		$data['hp'] = '44772';
		$data['attack'] = '85215';
		$data['defense'] = '50639';
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
		$data['strengthenLevel'] = '29380';
		$data['hp'] = '38324';
		$data['attack'] = '89829';
		$data['defense'] = '11959';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['strengthenLevel'] = '67530';
		$update['hp'] = '56559';
		$update['attack'] = '62727';
		$update['defense'] = '48103';
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
		$data['strengthenLevel'] = '37218';
		$data['hp'] = '44430';
		$data['attack'] = '65693';
		$data['defense'] = '13940';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

