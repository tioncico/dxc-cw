<?php

namespace UnitTest\Admin\Task;

use App\Model\Game\Task\GameTaskRewardModel;
use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;

/**
 * GameTaskRewardTest
 * Class GameTaskRewardTest
 * Create With ClassGeneration
 */
class GameTaskRewardTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Task/GameTaskReward';


	public function testAdd()
	{
		$data = [];
		$data['taskId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameTaskRewardModel();
		$model->destroy($response->result->taskRewardId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['taskId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$model = new GameTaskRewardModel();
		$model->data($data)->save();

		$data = [];
		$data['taskRewardId'] = $model->taskRewardId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->taskRewardId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['taskId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$model = new GameTaskRewardModel();
		$model->data($data)->save();

		$update = [];
		$update['taskRewardId'] = $model->taskRewardId;
		$update['taskId'] = mt_rand(10000, 99999);
		$update['goodsCode'] = "测试文本".Random::character(6);
		$update['num'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->taskRewardId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameTaskRewardModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['taskId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$model = new GameTaskRewardModel();
		$model->data($data)->save();

		$delData = [];
		$delData['taskRewardId'] = $model->taskRewardId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

