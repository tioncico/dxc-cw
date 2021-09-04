<?php

namespace UnitTest\User;

use UserJoinMapModel;

/**
 * UserJoinMapTest
 * Class UserJoinMapTest
 * Create With ClassGeneration
 */
class UserJoinMapTest extends UserBaseTestCase
{
	public $modelName = 'UserJoinMap';


	public function testAdd()
	{
		$data = [];
		$data['mapId'] = '35036';
		$data['nowLevel'] = '测试文本axELYg';
		$response = $this->request('add',$data);
		$model = new UserJoinMapModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mapId'] = '16768';
		$data['nowLevel'] = '测试文本hfIgb1';
		$model = new UserJoinMapModel();
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
		$data['mapId'] = '78414';
		$data['nowLevel'] = '测试文本PwmhXM';
		$model = new UserJoinMapModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['mapId'] = '43051';
		$update['nowLevel'] = '测试文本AuZtfX';
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserJoinMapModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['mapId'] = '76213';
		$data['nowLevel'] = '测试文本9yfumi';
		$model = new UserJoinMapModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

