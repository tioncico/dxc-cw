<?php

namespace UnitTest\User;

use UserMapModel;

/**
 * UserMapTest
 * Class UserMapTest
 * Create With ClassGeneration
 */
class UserMapTest extends UserBaseTestCase
{
	public $modelName = 'UserMap';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '85514';
		$data['mapId'] = '75176';
		$data['addTime'] = '23584';
		$response = $this->request('add',$data);
		$model = new UserMapModel();
		$model->destroy($response->result->userMapId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '49854';
		$data['mapId'] = '63253';
		$data['addTime'] = '25042';
		$model = new UserMapModel();
		$model->data($data)->save();

		$data = [];
		$data['userMapId'] = $model->userMapId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userMapId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = '66630';
		$data['mapId'] = '14388';
		$data['addTime'] = '89049';
		$model = new UserMapModel();
		$model->data($data)->save();

		$update = [];
		$update['userMapId'] = $model->userMapId;
		$update['userId'] = '53641';
		$update['mapId'] = '86615';
		$update['addTime'] = '76930';
		$response = $this->request('update',$update);
		$model->destroy($model->userMapId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserMapModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = '28321';
		$data['mapId'] = '95447';
		$data['addTime'] = '38849';
		$model = new UserMapModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userMapId'] = $model->userMapId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

