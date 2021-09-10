<?php

namespace UnitTest\Admin;

use UserSignModel;

/**
 * UserSignTest
 * Class UserSignTest
 * Create With ClassGeneration
 */
class UserSignTest extends AdminBaseTestCase
{
	public $modelName = 'UserSign';


	public function testAdd()
	{
		$data = [];
		$data['signNum'] = '98027';
		$data['lastUpdateTime'] = '69813';
		$response = $this->request('add',$data);
		$model = new UserSignModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['signNum'] = '64284';
		$data['lastUpdateTime'] = '61598';
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
		$data['signNum'] = '51514';
		$data['lastUpdateTime'] = '39886';
		$model = new UserSignModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['signNum'] = '84548';
		$update['lastUpdateTime'] = '78784';
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
		$data['signNum'] = '78962';
		$data['lastUpdateTime'] = '19756';
		$model = new UserSignModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

