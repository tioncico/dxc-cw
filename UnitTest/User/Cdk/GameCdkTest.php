<?php

namespace UnitTest\User\Cdk;

use EasySwoole\Utility\Random;
use GameCdkModel;
use UnitTest\User\UserBaseTestCase;

/**
 * GameCdkTest
 * Class GameCdkTest
 * Create With ClassGeneration
 */
class GameCdkTest extends UserBaseTestCase
{
	public $modelName = 'Cdk/GameCdk';


	public function testAdd()
	{
		$data = [];
		$data['cdk'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['endTime'] = mt_rand(10000, 99999);
		$data['status'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameCdkModel();
		$model->destroy($response->result->cdkId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUseCdk()
	{
		$data = [];
		$data['cdk'] = "6PTuGRsv";
		$response = $this->request('useCdk',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['cdk'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['endTime'] = mt_rand(10000, 99999);
		$data['status'] = mt_rand(10000, 99999);
		$model = new GameCdkModel();
		$model->data($data)->save();

		$data = [];
		$data['cdkId'] = $model->cdkId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->cdkId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['cdk'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['endTime'] = mt_rand(10000, 99999);
		$data['status'] = mt_rand(10000, 99999);
		$model = new GameCdkModel();
		$model->data($data)->save();

		$update = [];
		$update['cdkId'] = $model->cdkId;
		$update['cdk'] = "测试文本".Random::character(6);
		$update['num'] = mt_rand(10000, 99999);
		$update['addTime'] = mt_rand(10000, 99999);
		$update['endTime'] = mt_rand(10000, 99999);
		$update['status'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->cdkId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameCdkModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['cdk'] = "测试文本".Random::character(6);
		$data['num'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['endTime'] = mt_rand(10000, 99999);
		$data['status'] = mt_rand(10000, 99999);
		$model = new GameCdkModel();
		$model->data($data)->save();

		$delData = [];
		$delData['cdkId'] = $model->cdkId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

