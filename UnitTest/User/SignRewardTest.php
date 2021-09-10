<?php

namespace UnitTest\User;

use SignRewardModel;

/**
 * SignRewardTest
 * Class SignRewardTest
 * Create With ClassGeneration
 */
class SignRewardTest extends UserBaseTestCase
{
	public $modelName = 'SignReward';


	public function testAdd()
	{
		$data = [];
		$data['id'] = '63444';
		$data['signNum'] = '91525';
		$data['money'] = '78921';
		$response = $this->request('add',$data);
		$model = new SignRewardModel();
		$model->destroy($response->result->);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['id'] = '67419';
		$data['signNum'] = '84445';
		$data['money'] = '71253';
		$model = new SignRewardModel();
		$model->data($data)->save();

		$data = [];
		$data[''] = $model->;
		$response = $this->request('getOne',$data);
		$model->destroy($model->);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['id'] = '54633';
		$data['signNum'] = '75185';
		$data['money'] = '15322';
		$model = new SignRewardModel();
		$model->data($data)->save();

		$update = [];
		$update[''] = $model->;
		$update['id'] = '54642';
		$update['signNum'] = '27932';
		$update['money'] = '96944';
		$response = $this->request('update',$update);
		$model->destroy($model->);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new SignRewardModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['id'] = '66638';
		$data['signNum'] = '59406';
		$data['money'] = '12182';
		$model = new SignRewardModel();
		$model->data($data)->save();

		$delData = [];
		$delData[''] = $model->;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

