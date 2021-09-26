<?php

namespace UnitTest\User\Task;

use App\Model\Game\Task\GameDailyTaskPointRewardModel;
use EasySwoole\Utility\Random;
use UnitTest\User\UserBaseTestCase;

/**
 * GameDailyTaskPointRewardTest
 * Class GameDailyTaskPointRewardTest
 * Create With ClassGeneration
 */
class GameDailyTaskPointRewardTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Task/GameDailyTaskPointReward';


	public function testAdd()
	{
		$data = [];
		$data['type'] = mt_rand(10000, 99999);
		$data['pointNum'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameDailyTaskPointRewardModel();
		$model->destroy($response->result->rewardId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['type'] = mt_rand(10000, 99999);
		$data['pointNum'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskPointRewardModel();
		$model->data($data)->save();

		$data = [];
		$data['rewardId'] = $model->rewardId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->rewardId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['type'] = mt_rand(10000, 99999);
		$data['pointNum'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskPointRewardModel();
		$model->data($data)->save();

		$update = [];
		$update['rewardId'] = $model->rewardId;
		$update['type'] = mt_rand(10000, 99999);
		$update['pointNum'] = mt_rand(10000, 99999);
		$update['goodsCode'] = "测试文本".Random::character(6);
		$update['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->rewardId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameDailyTaskPointRewardModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['type'] = mt_rand(10000, 99999);
		$data['pointNum'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameDailyTaskPointRewardModel();
		$model->data($data)->save();

		$delData = [];
		$delData['rewardId'] = $model->rewardId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

