<?php

namespace UnitTest\Admin\Task;

use App\Model\Game\Task\GameTaskModel;
use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;

/**
 * GameTaskTest
 * Class GameTaskTest
 * Create With ClassGeneration
 */
class GameTaskTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Task/GameTask';


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

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
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

