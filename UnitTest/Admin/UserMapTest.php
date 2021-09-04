<?php

namespace UnitTest\Admin;

use UserMapModel;

/**
 * UserMapTest
 * Class UserMapTest
 * Create With ClassGeneration
 */
class UserMapTest extends AdminBaseTestCase
{
	public $modelName = 'UserMap';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '46996';
		$data['mapId'] = '77865';
		$data['addTime'] = '31709';
		$response = $this->request('add',$data);
		$model = new UserMapModel();
		$model->destroy($response->result->userMapId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '45203';
		$data['mapId'] = '89046';
		$data['addTime'] = '21349';
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
		$data['userId'] = '96212';
		$data['mapId'] = '55030';
		$data['addTime'] = '42515';
		$model = new UserMapModel();
		$model->data($data)->save();

		$update = [];
		$update['userMapId'] = $model->userMapId;
		$update['userId'] = '68957';
		$update['mapId'] = '54025';
		$update['addTime'] = '23250';
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
		$data['userId'] = '35191';
		$data['mapId'] = '39463';
		$data['addTime'] = '11332';
		$model = new UserMapModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userMapId'] = $model->userMapId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

