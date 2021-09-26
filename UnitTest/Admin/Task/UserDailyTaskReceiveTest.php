<?php

namespace UnitTest\Admin\Task;

use App\Model\Game\Task\UserDailyTaskReceiveModel;
use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;

/**
 * UserDailyTaskReceiveTest
 * Class UserDailyTaskReceiveTest
 * Create With ClassGeneration
 */
class UserDailyTaskReceiveTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Task/UserDailyTaskReceive';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['rewardId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserDailyTaskReceiveModel();
		$model->destroy($response->result->userDailyTaskReceiveId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['rewardId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskReceiveModel();
		$model->data($data)->save();

		$data = [];
		$data['userDailyTaskReceiveId'] = $model->userDailyTaskReceiveId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userDailyTaskReceiveId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['rewardId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskReceiveModel();
		$model->data($data)->save();

		$update = [];
		$update['userDailyTaskReceiveId'] = $model->userDailyTaskReceiveId;
		$update['userId'] = mt_rand(10000, 99999);
		$update['rewardId'] = mt_rand(10000, 99999);
		$update['addTime'] = mt_rand(10000, 99999);
		$update['date'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userDailyTaskReceiveId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserDailyTaskReceiveModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['rewardId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['date'] = mt_rand(10000, 99999);
		$model = new UserDailyTaskReceiveModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userDailyTaskReceiveId'] = $model->userDailyTaskReceiveId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

