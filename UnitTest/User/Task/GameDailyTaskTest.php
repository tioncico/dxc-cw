<?php

namespace UnitTest\User\Task;

use App\Model\Game\Task\GameDailyTaskModel;
use EasySwoole\Utility\Random;
use UnitTest\User\UserBaseTestCase;

/**
 * GameDailyTaskTest
 * Class GameDailyTaskTest
 * Create With ClassGeneration
 */
class GameDailyTaskTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Task/GameDailyTask';


	public function testAdd()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['code'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['rewardPoint'] = mt_rand(10000, 99999);
		$data['maxNum'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameDailyTaskModel();
		$model->destroy($response->result->gameDailyTaskId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['code'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['rewardPoint'] = mt_rand(10000, 99999);
		$data['maxNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskModel();
		$model->data($data)->save();

		$data = [];
		$data['gameDailyTaskId'] = $model->gameDailyTaskId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->gameDailyTaskId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['code'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['rewardPoint'] = mt_rand(10000, 99999);
		$data['maxNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskModel();
		$model->data($data)->save();

		$update = [];
		$update['gameDailyTaskId'] = $model->gameDailyTaskId;
		$update['name'] = "测试文本".Random::character(6);
		$update['code'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['rewardPoint'] = mt_rand(10000, 99999);
		$update['maxNum'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->gameDailyTaskId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameDailyTaskModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['code'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['rewardPoint'] = mt_rand(10000, 99999);
		$data['maxNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskModel();
		$model->data($data)->save();

		$delData = [];
		$delData['gameDailyTaskId'] = $model->gameDailyTaskId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

