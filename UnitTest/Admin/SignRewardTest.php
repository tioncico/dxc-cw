<?php

namespace UnitTest\Admin;

use SignRewardModel;

/**
 * SignRewardTest
 * Class SignRewardTest
 * Create With ClassGeneration
 */
class SignRewardTest extends AdminBaseTestCase
{
	public $modelName = 'SignReward';


	public function testAdd()
	{
		$data = [];
		$data['id'] = '57899';
		$data['signNum'] = '85414';
		$data['money'] = '59186';
		$response = $this->request('add',$data);
		$model = new SignRewardModel();
		$model->destroy($response->result);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['id'] = '70208';
		$data['signNum'] = '87529';
		$data['money'] = '20402';
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
		$data['id'] = '16912';
		$data['signNum'] = '34055';
		$data['money'] = '63353';
		$model = new SignRewardModel();
		$model->data($data)->save();

		$update = [];
		$update[''] = $model->;
		$update['id'] = '45566';
		$update['signNum'] = '23055';
		$update['money'] = '22184';
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
		$data['id'] = '51750';
		$data['signNum'] = '54600';
		$data['money'] = '61035';
		$model = new SignRewardModel();
		$model->data($data)->save();

		$delData = [];
		$delData[''] = $model->;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

