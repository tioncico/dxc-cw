<?php

namespace UnitTest\User;

use UserSignModel;

/**
 * UserSignTest
 * Class UserSignTest
 * Create With ClassGeneration
 */
class UserSignTest extends UserBaseTestCase
{
	public $modelName = 'UserSign';


	public function testAdd()
	{
		$data = [];
		$data['signNum'] = '38633';
		$data['lastUpdateTime'] = '51160';
		$response = $this->request('add',$data);
		$model = new UserSignModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['signNum'] = '58246';
		$data['lastUpdateTime'] = '62434';
		$model = new UserSignModel();
		$model->data($data)->save();

		$data = [];
		$data['userId'] = $model->userId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['signNum'] = '79301';
		$data['lastUpdateTime'] = '45465';
		$model = new UserSignModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['signNum'] = '79864';
		$update['lastUpdateTime'] = '78735';
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserSignModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['signNum'] = '17923';
		$data['lastUpdateTime'] = '67911';
		$model = new UserSignModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

