<?php

namespace UnitTest\Admin\Task;

use App\Model\Game\Task\GameTaskMasterModel;
use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;

/**
 * GameTaskMasterTest
 * Class GameTaskMasterTest
 * Create With ClassGeneration
 */
class GameTaskMasterTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Task/GameTaskMaster';


	public function testAdd()
	{
		$data = [];
		$data['type'] = "测试文本".Random::character(6);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameTaskMasterModel();
		$model->destroy($response->result->taskMasterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['type'] = "测试文本".Random::character(6);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$model = new GameTaskMasterModel();
		$model->data($data)->save();

		$data = [];
		$data['taskMasterId'] = $model->taskMasterId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->taskMasterId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['type'] = "测试文本".Random::character(6);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$model = new GameTaskMasterModel();
		$model->data($data)->save();

		$update = [];
		$update['taskMasterId'] = $model->taskMasterId;
		$update['type'] = "测试文本".Random::character(6);
		$update['name'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['order'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->taskMasterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameTaskMasterModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['type'] = "测试文本".Random::character(6);
		$data['name'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['order'] = mt_rand(10000, 99999);
		$model = new GameTaskMasterModel();
		$model->data($data)->save();

		$delData = [];
		$delData['taskMasterId'] = $model->taskMasterId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

