<?php

namespace UnitTest\User\Task;

use App\Model\Game\Task\GameTaskModel;
use EasySwoole\Utility\Random;
use UnitTest\User\UserBaseTestCase;

/**
 * GameTaskTest
 * Class GameTaskTest
 * Create With ClassGeneration
 */
class GameTaskTest extends UserBaseTestCase
{
	public $modelName = 'Task/GameTask';


	public function testAdd()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['code'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$response = $this->request('add',$data);
		$model = new GameTaskModel();
		$model->destroy($response->result->taskId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['code'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$model = new GameTaskModel();
		$model->data($data)->save();

		$data = [];
		$data['taskId'] = $model->taskId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->taskId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['code'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$model = new GameTaskModel();
		$model->data($data)->save();

		$update = [];
		$update['taskId'] = $model->taskId;
		$update['taskMasterId'] = mt_rand(10000, 99999);
		$update['code'] = "测试文本".Random::character(6);
		$update['order'] = mt_rand(10000, 99999);
		$update['completeNum'] = mt_rand(10000, 99999);
		$update['name'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['param'] = "测试文本".Random::character(6);
		$response = $this->request('update',$update);
		$model->destroy($model->taskId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameTaskModel();
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testGetDailyList()
	{
		$model = new GameTaskModel();
		$data = [];
		$response = $this->request('getDailyList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}


	public function testGetDailyPointInfo()
	{
		$model = new GameTaskModel();
		$data = [];
		$response = $this->request('getDailyPointInfo',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testComplete()
	{
		$model = new GameTaskModel();
		$data = [
		    'taskId'=>1
        ];
		$response = $this->request('complete',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testReceiveDailyReward()
	{
		$model = new GameTaskModel();
		$data = [
		    'rewardId'=>2
        ];
		$response = $this->request('receiveDailyReward',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}


	public function testDel()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['code'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$data['completeNum'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$model = new GameTaskModel();
		$model->data($data)->save();

		$delData = [];
		$delData['taskId'] = $model->taskId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

