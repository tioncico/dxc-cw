<?php

namespace UnitTest\Admin;

use UserJoinMapModel;

/**
 * UserJoinMapTest
 * Class UserJoinMapTest
 * Create With ClassGeneration
 */
class UserJoinMapTest extends AdminBaseTestCase
{
	public $modelName = 'UserJoinMap';


	public function testAdd()
	{
		$data = [];
		$data['mapId'] = '73640';
		$data['nowLevel'] = '测试文本gy7vPw';
		$response = $this->request('add',$data);
		$model = new UserJoinMapModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mapId'] = '23798';
		$data['nowLevel'] = '测试文本0cS4pv';
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
		$data['mapId'] = '69712';
		$data['nowLevel'] = '测试文本mCrMKl';
		$model = new UserJoinMapModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['mapId'] = '22482';
		$update['nowLevel'] = '测试文本lKAIap';
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
		$data['mapId'] = '19370';
		$data['nowLevel'] = '测试文本Jxizbr';
		$model = new UserJoinMapModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

