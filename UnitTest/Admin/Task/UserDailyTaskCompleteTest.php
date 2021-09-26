<?php

namespace UnitTest\Admin\Task;

use App\Model\Game\Task\UserDailyTaskCompleteModel;
use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;

/**
 * UserDailyTaskCompleteTest
 * Class UserDailyTaskCompleteTest
 * Create With ClassGeneration
 */
class UserDailyTaskCompleteTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Task/UserDailyTaskComplete';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['gameDailyTaskId'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserDailyTaskCompleteModel();
		$model->destroy($response->result->userDailyTaskCompleteId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['gameDailyTaskId'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskCompleteModel();
		$model->data($data)->save();

		$data = [];
		$data['userDailyTaskCompleteId'] = $model->userDailyTaskCompleteId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userDailyTaskCompleteId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['gameDailyTaskId'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskCompleteModel();
		$model->data($data)->save();

		$update = [];
		$update['userDailyTaskCompleteId'] = $model->userDailyTaskCompleteId;
		$update['userId'] = mt_rand(10000, 99999);
		$update['gameDailyTaskId'] = mt_rand(10000, 99999);
		$update['completeNum'] = mt_rand(10000, 99999);
		$update['date'] = mt_rand(10000, 99999);
		$update['addTime'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userDailyTaskCompleteId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserDailyTaskCompleteModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['gameDailyTaskId'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskCompleteModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userDailyTaskCompleteId'] = $model->userDailyTaskCompleteId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

