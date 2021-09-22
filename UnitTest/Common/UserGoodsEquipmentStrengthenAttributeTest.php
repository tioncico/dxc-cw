<?php

namespace UnitTest\Common;

use App\Model\UserGoodsEquipmentStrengthenAttributeModel;

/**
 * UserGoodsEquipmentStrengthenAttributeTest
 * Class UserGoodsEquipmentStrengthenAttributeTest
 * Create With ClassGeneration
 */
class UserGoodsEquipmentStrengthenAttributeTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/UserGoodsEquipmentStrengthenAttribute';


	public function testAdd()
	{
		$data = [];
		$data['strengthenLevel'] = '79307';
		$data['hp'] = '51310';
		$data['attack'] = '98972';
		$data['defense'] = '34319';
		$response = $this->request('add',$data);
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['strengthenLevel'] = '16245';
		$data['hp'] = '47365';
		$data['attack'] = '42600';
		$data['defense'] = '73465';
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
		$data['strengthenLevel'] = '24045';
		$data['hp'] = '81140';
		$data['attack'] = '79330';
		$data['defense'] = '58842';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['strengthenLevel'] = '53905';
		$update['hp'] = '57640';
		$update['attack'] = '44841';
		$update['defense'] = '91167';
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
		$data['strengthenLevel'] = '91578';
		$data['hp'] = '70139';
		$data['attack'] = '32604';
		$data['defense'] = '38345';
		$model = new UserGoodsEquipmentStrengthenAttributeModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

