<?php

namespace UnitTest\User;

use UserLevelConfigModel;

/**
 * UserLevelConfigTest
 * Class UserLevelConfigTest
 * Create With ClassGeneration
 */
class UserLevelConfigTest extends UserBaseTestCase
{
	public $modelName = 'UserLevelConfig';


	public function testAdd()
	{
		$data = [];
		$data['exp'] = '33223';
		$response = $this->request('add',$data);
		$model = new UserLevelConfigModel();
		$model->destroy($response->result->level);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['exp'] = '56852';
		$model = new UserLevelConfigModel();
		$model->data($data)->save();

		$data = [];
		$data['level'] = $model->level;
		$response = $this->request('getOne',$data);
		$model->destroy($model->level);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['exp'] = '36512';
		$model = new UserLevelConfigModel();
		$model->data($data)->save();

		$update = [];
		$update['level'] = $model->level;
		$update['exp'] = '53085';
		$response = $this->request('update',$update);
		$model->destroy($model->level);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserLevelConfigModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['exp'] = '96836';
		$model = new UserLevelConfigModel();
		$model->data($data)->save();

		$delData = [];
		$delData['level'] = $model->level;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

