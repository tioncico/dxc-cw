<?php

namespace UnitTest\User\Task;

use App\Model\Game\Task\UserGameTaskCompleteModel;
use EasySwoole\Utility\Random;
use UnitTest\User\UserBaseTestCase;

/**
 * UserGameTaskCompleteTest
 * Class UserGameTaskCompleteTest
 * Create With ClassGeneration
 */
class UserGameTaskCompleteTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Task/UserGameTaskComplete';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['taskId'] = mt_rand(10000, 99999);
		$data['taskCode'] = "测试文本".Random::character(6);
		$data['nowNum'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['state'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserGameTaskCompleteModel();
		$model->destroy($response->result->userTaskCompleteId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['taskId'] = mt_rand(10000, 99999);
		$data['taskCode'] = "测试文本".Random::character(6);
		$data['nowNum'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['state'] = mt_rand(10000, 99999);
		$model = new UserGameTaskCompleteModel();
		$model->data($data)->save();

		$data = [];
		$data['userTaskCompleteId'] = $model->userTaskCompleteId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userTaskCompleteId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['taskId'] = mt_rand(10000, 99999);
		$data['taskCode'] = "测试文本".Random::character(6);
		$data['nowNum'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['state'] = mt_rand(10000, 99999);
		$model = new UserGameTaskCompleteModel();
		$model->data($data)->save();

		$update = [];
		$update['userTaskCompleteId'] = $model->userTaskCompleteId;
		$update['userId'] = mt_rand(10000, 99999);
		$update['taskId'] = mt_rand(10000, 99999);
		$update['taskCode'] = "测试文本".Random::character(6);
		$update['nowNum'] = mt_rand(10000, 99999);
		$update['completeNum'] = mt_rand(10000, 99999);
		$update['state'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userTaskCompleteId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserGameTaskCompleteModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['taskId'] = mt_rand(10000, 99999);
		$data['taskCode'] = "测试文本".Random::character(6);
		$data['nowNum'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['state'] = mt_rand(10000, 99999);
		$model = new UserGameTaskCompleteModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userTaskCompleteId'] = $model->userTaskCompleteId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

