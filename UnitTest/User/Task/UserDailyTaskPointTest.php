<?php

namespace UnitTest\User\Task;

use App\Model\Game\Task\UserDailyTaskPointModel;
use EasySwoole\Utility\Random;
use UnitTest\User\UserBaseTestCase;

/**
 * UserDailyTaskPointTest
 * Class UserDailyTaskPointTest
 * Create With ClassGeneration
 */
class UserDailyTaskPointTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Task/UserDailyTaskPoint';


	public function testAdd()
	{
		$data = [];
		$data['weekPointNum'] = mt_rand(10000, 99999);
		$data['dailyPointNum'] = mt_rand(10000, 99999);
		$data['lastUpdateTime'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserDailyTaskPointModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['weekPointNum'] = mt_rand(10000, 99999);
		$data['dailyPointNum'] = mt_rand(10000, 99999);
		$data['lastUpdateTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskPointModel();
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
		$data['weekPointNum'] = mt_rand(10000, 99999);
		$data['dailyPointNum'] = mt_rand(10000, 99999);
		$data['lastUpdateTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskPointModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['weekPointNum'] = mt_rand(10000, 99999);
		$update['dailyPointNum'] = mt_rand(10000, 99999);
		$update['lastUpdateTime'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserDailyTaskPointModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['weekPointNum'] = mt_rand(10000, 99999);
		$data['dailyPointNum'] = mt_rand(10000, 99999);
		$data['lastUpdateTime'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskPointModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

